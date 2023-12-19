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
        $apiKey = 'AfoJoAfd7t5SXkXcBeywlTEf4KLsfCRJbRTjCDKA9dWrSZBfqWXmVnpRPkywNOf5';
        $apiSign = '39f2af1cddd0374536302a2762626065';
        $type = 'services';
        $filterType = 'game';
        $filterValue = '';

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
        $apiKey = 'AfoJoAfd7t5SXkXcBeywlTEf4KLsfCRJbRTjCDKA9dWrSZBfqWXmVnpRPkywNOf5';
        $apiSign = '39f2af1cddd0374536302a2762626065';
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

        // midtrans integrate
        $payload = [
            'transaction_details' => [
                'order_id' => $no_invoice,
                'gross_amount' => $selectedCategory[1],
            ],
        ];
        
        $snapToken = \Midtrans\Snap::getSnapToken($payload);
        return view ('pages.order', compact('snapToken', 'invoice', 'no_invoice'));
    }
    public function midtransCallback(Request $request)
    {

        $notif = new \Midtrans\Notification();

        $serverKey = config('services.midtrans.serverKey');
        $hashed = hash("sha512", $notif->order_id . $notif->status_code . $notif->gross_amount . $serverKey);
        if ($hashed == $notif->signature_key) {
            if($notif->transaction_status == 'capture' || $notif->transaction_status == 'settlement'){
                $order = midtrans::find($notif->order_id);
                $order->update(['status' => 'Paid']);

                // vippayment proses
                if($order->status == 'Paid'){
                    $this->fetchOrderAPI($order->packet_name, $order->user_id, $order->user_zone);
                }
            }
        } 
    }
    public function invoiceOrder($trx_id)
    {
        $invoice = midtrans::find($trx_id);
        return view('pages.invoice', compact('invoice', 'trx_id'));
    }
    public function midtransStatus($Request, $request) {
        return view('pages.invoice', compact('order'));
    }
}