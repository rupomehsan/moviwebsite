<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        // require 'vendor/autoload.php';
        // dd('kdjdj');
        // This is your test secret API key.
        \Stripe\Stripe::setApiKey('sk_test_51LBZSsKUsyg2bTQ9qHqXd79q6wC0PdmKI6SmJ7sSBysjsSYHcigrZ82z1d8keYu39QCQhf8QRaqHTg2XbK6zgQJZ00G2ovhAz4');

        header('Content-Type: application/json');

        // $YOUR_DOMAIN = env('APP_URL');

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items'  => [[
                'price_data' => [
                    'currency'     => 'usd',
                    'product_data' => [
                        'name' => 'T-shirt',
                    ],
                    'unit_amount'  => 2000,
                ],
                'quantity'   => 1,
            ]],
            'mode'        => 'payment',
            'success_url' => env('APP_URL') . '/success.html?id=',
            'cancel_url'  => env('APP_URL') . '/cancel.html',
        ]);

        // return Redirect::to($checkout_session->url);

        echo '<pre>';
        print_r($checkout_session);
        exit;

        // header("HTTP/1.1 303 See Other");
        // header("Location: " . $checkout_session->url);

    }
}
