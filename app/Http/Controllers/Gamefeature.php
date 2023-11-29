<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use App\Models\midtrans;

class Gamefeature extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

    // Fetch API
    private function fetchGetAPI() {
        $apiUrl = 'https://vip-reseller.co.id/api/game-feature';
        $apiKey = 'RPPTa5cvN6uJFSiOZNuOrc1B2EWWujWuLuiygpZXsGhubm14k9puwdzHuRctP7Cr';
        $apiSign = '1469d60a00d32036055f77ad8bff4423';
        $type = 'services';
        $filterType = 'game';
        $filterValue = 'Mobile Legends B';

        return Http::asForm()->post($apiUrl, [
            'key' => $apiKey,
            'sign' => $apiSign,
            'type' => $type,
            'filter_type' => $filterType,
            'filter_value' => $filterValue,
        ]);
    }

    private function trackOrderAPI($trxid)
    {
        $apiUrl = 'https://vip-reseller.co.id/api/game-feature';
        $apiKey = 'RPPTa5cvN6uJFSiOZNuOrc1B2EWWujWuLuiygpZXsGhubm14k9puwdzHuRctP7Cr';
        $apiSign = '1469d60a00d32036055f77ad8bff4423';
        $type = 'status';

        return Http::asForm()->post($apiUrl, [
            'key' => $apiKey,
            'sign' => $apiSign,
            'type' => $type,
            'trxid' => $trxid,
        ]);
    }

    private function fetchOrderAPI($selectedCategory, $dataNo, $dataZone)
    {
        $apiUrl = 'https://vip-reseller.co.id/api/game-feature';
        $apiKey = 'RPPTa5cvN6uJFSiOZNuOrc1B2EWWujWuLuiygpZXsGhubm14k9puwdzHuRctP7Cr';
        $apiSign = '1469d60a00d32036055f77ad8bff4423';
        $type = 'order';
    
        return Http::asForm()->post($apiUrl, [
            'key' => $apiKey,
            'sign' => $apiSign,
            'type' => $type,
            'service' => $selectedCategory,
            'data_no' => $dataNo,
            'data_zone' => $dataZone,
        ]);
    }

    // Action
    public function getGameService()
    {
        $response = $this->fetchGetAPI();
        if ($response->successful()) {
            $data = $response->json();
            // @dd($data);  
            return view('pages.home', compact('data'));
        } else {
            $error = $response->json();
            dd($error);
        }
    }

    public function trackOrderGameService(Request $request)
    {
        $trxid = $request->query('trxid');
        $response = $this->trackOrderAPI($trxid);

        if ($response->successful()) {
            $responseData = $response->json();
            return view('pages.track-order', ['responseData' => $responseData]);
        } else {
            $errorResponse = $response->json();
            return response()->json(['error' => $errorResponse], $response->status());
        }
        return view('pages.track-order');
    }

    public function orderGameService(Request $request)
    {   
        /**
         * algorithm generate no invoice
         */
        $length = 10;
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        }

        //generate no invoice
        $no_invoice = 'TRX-'.Str::upper($random);

        // pecah data selectedCategory after coma jadikan hanya 1 data tanpa array
        $selectedCategory = explode(',', $request->selectedCategory);
        
        // sent to database
        $invoice = midtrans::create([
            'trx_id' => $no_invoice,
            'user_id' => $request->idUser,
            'user_zone' => $request->zone,
            'packet_name' => $selectedCategory[0],
            'total_price' => $selectedCategory[1],
        ]);

        // ambil dari database status unpaid dari trx_id
        $statusSearch = midtrans::where('trx_id', $no_invoice)->first();
        $status = $statusSearch->status;
        
        // midtrans integrate
        $payload = [
            'transaction_details' => [
                'order_id' => $no_invoice,
                'gross_amount' => $selectedCategory[1],
            ],
        ];

        # vipayment proses
        $selectedCategory = $invoice->packet_name;
        $dataNo = $invoice->user_id;
        $dataZone = $invoice->user_zone;

        $this->fetchOrderAPI($selectedCategory, $dataNo, $dataZone);
        
        $snapToken = \Midtrans\Snap::getSnapToken($payload);
        return view ('pages.order', compact('snapToken', 'invoice', 'status'));
    }

}