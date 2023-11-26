<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey    = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$isSanitized  = env('MIDTRANS_IS_SANITIZED');
        \Midtrans\Config::$is3ds        = env('MIDTRANS_IS_3DS');
    }

    public function pay(Request $request){
        $midtrans = \App\Models\midtrans::create([
            'code'   => 'Midtrans-' . mt_rand(100000, 999999),
            'name'   => $request->name,
            'email'  => $request->email,
            'amount' => $request->amount,
            'note'   => $request->note,
        ]);
    }
}
