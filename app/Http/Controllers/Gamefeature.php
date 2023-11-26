<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;

use Midtrans\Config as Config;
use Midtrans\Snap;
class Gamefeature extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey    = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$isSanitized  = env('MIDTRANS_IS_SANITIZED');
        \Midtrans\Config::$is3ds        = env('MIDTRANS_IS_3DS');
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
        # pembayaran berhasil, baru masuk ke vipayment
        $midtrans = \App\Models\midtrans::create([
            'trx_id'   => 'TopupML-' . mt_rand(100000, 999999),
            'user_id' => $request->input('idUser'),
            'user_zone' => $request->input('zone'),
        ]);

        # vipayment proses
        // $selectedCategory = $request->input('selectedCategory');
        // $dataNo = $request->input('dataNo');
        // $dataZone = $request->input('dataZone');
        
        $response = $this->fetchGetAPI();

        if ($response->successful()) {
            $data = $response->json();
            return view('pages.home', compact('data'));
        } else {
            $error = $response->json();
            dd($error);
        }
    }

}