<?php

namespace App\Controllers;
use Midtrans\Config;

class Payment extends BaseController
{
    public function index()
    {

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-e6uKjRLaAY-xnGTIXkyrLcoi';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 150000,
            ),
            'customer_details' => array(
                'first_name' => 'gugun',
                'last_name' => 'gunawan',
                'email' => 'gunawan@google.com',
                'phone' => '10000',
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $data ['token'] = $snapToken;
 

        return view('pesanan/pembayaran', $data);
    }
}
