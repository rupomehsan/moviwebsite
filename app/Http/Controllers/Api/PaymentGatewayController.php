<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentGatway;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    public function index(Request $request)
    {
        try {
            $target = PaymentGatway::first();
            return response([
                'status' => 'success',
                'data'   => $target,
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function paymentSheet(Request $request)
    {
        // dd($request->all());
        try {

            if (auth()->user()->email === 'demo@wallpaper.com') {
                return response([
                    'status'  => 'authentication_error',
                    'message' => 'Sorry, You can not update this item',
                ], 401);
            } else {

                $paymentGatewayInfo = PaymentGatway::first();

                \Stripe\Stripe::setApiKey($paymentGatewayInfo->stripe_secret_key);
                // Use an existing Customer ID if this is a returning customer.
                $customer     = \Stripe\Customer::create();
                $ephemeralKey = \Stripe\EphemeralKey::create(
                    [
                        'customer' => $customer->id,
                    ],
                    [
                        'stripe_version' => '2020-08-27',
                    ]);
                $paymentIntent = \Stripe\PaymentIntent::create([
                    'amount'                    => (int) $request->amount . '00',
                    'currency'                  => 'usd',
                    'customer'                  => $customer->id,
                    'automatic_payment_methods' => [
                        'enabled' => 'true',
                    ],
                ]);

                return response([
                    'paymentIntent'  => $paymentIntent->client_secret,
                    'ephemeralKey'   => $ephemeralKey->secret,
                    'customer'       => $customer->id,
                    'publishableKey' => $paymentGatewayInfo->stripe_publishable_key,
                ], 200);

            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
