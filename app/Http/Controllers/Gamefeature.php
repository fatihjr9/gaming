<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

use App\Models\midtrans;

use Midtrans\Config as Config;
use Midtrans\Snap;
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
        $apiKey = 'kS4zvaUVFTsOd649a350qZvAWrPF4EgrqyVoeDa7VUgNldo9wnwNwxUqLdYA9ZdH';
        $apiSign = 'fda5edb12e9940e723d43eecbc9227b8';
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

    private function fetchOrderAPI($selectedCategory, $dataNo, $dataZone)
    {
        $apiUrl = 'https://vip-reseller.co.id/api/game-feature';
        $apiKey = 'kS4zvaUVFTsOd649a350qZvAWrPF4EgrqyVoeDa7VUgNldo9wnwNwxUqLdYA9ZdH';
        $apiSign = 'fda5edb12e9940e723d43eecbc9227b8';
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
        $dataNo = $invoice->idUser;
        $dataZone = $invoice->zone;

        $response = $this->fetchOrderAPI($selectedCategory, $dataNo, $dataZone);

        if ($response->successful()) {
            $data = $response->json();
            return view('pages.home', compact('data'));
        } else {
            $error = $response->json();
        }
        
        $snapToken = \Midtrans\Snap::getSnapToken($payload);
        return view ('pages.order', compact('snapToken', 'invoice', 'status'));
        
    }

}