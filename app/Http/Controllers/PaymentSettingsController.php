<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageSubscriber;
use App\Models\PaymentGatway;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Response;
use Session;

class PaymentSettingsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $target = PaymentGatway::first();
            return view('paymentSettings.index')->with(compact('target'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function update(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                // dd($request->all());

                $target                         = new PaymentGatway;
                $target->paypal_client_id       = $request->paypal_client_id;
                $target->paypal_secret          = $request->paypal_secret;
                $target->stripe_publishable_key = $request->stripe_publishable_key;
                $target->stripe_secret_key      = $request->stripe_secret_key;

                $prev = PaymentGatway::first();
                if (!empty($prev)) {
                    $prev->delete();
                }

                if ($target->save()) {
                    Session::flash('success', "Payment Settings Updated Successfully!");
                    return redirect('admin/payment-settings');
                } else {
                    Session::flash('error', "Payment Settings Update Unsuccessfull!");
                    return redirect('admin/payment-settings');
                }
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    //Start:: transaction initialised
    public function transactionInitialise(Request $request)
    {
        try {
            $target                  = new Transaction();
            $target->user_id         = auth()->id();
            $target->package_id      = $request->package_id;
            $target->payment_method  = $request->payment_method;
            $target->gatway_response = '';
            $target->status          = 'initialised';

            if ($target->save()) {
                return Response::json(['success' => true, 'transactionId' => $target->id], 200);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    //End:: transaction initialised

    // Start:: Paypal payment
    public function paypalTransactionDataStore(Request $request)
    {
        try {
            //transaction history
            $transaction = Transaction::where('id', $request->transactionId)->first();
            if (empty($transaction)) {
                Session::flash('error', 'Invalid Data Id');
            }
            $transaction->gatway_response = $request->data;
            $transaction->status          = 'payment';

            //transacted package
            $package = Package::where('id', $transaction->package_id)->first();

            // dd($transaction);
            if ($transaction->update()) {
                $subscriber                 = new PackageSubscriber();
                $subscriber->user_id        = auth()->id();
                $subscriber->transaction_id = $transaction->id;
                $subscriber->package_id     = $transaction->package_id;
                $subscriber->amount         = $package->price;
                $subscriber->period         = $package->validity;
                $subscriber->start_date     = Carbon::now();
                $subscriber->end_date       = Carbon::now()->addDays($package->validity);
                $subscriber->save();

                return Response::json(['success' => true], 200);
            }

        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    // End:: Paypal payment

    // Start:: stripe payment
    public function stripeTransactionDataStore(Request $request)
    {
        $gatWay = PaymentGatway::first();
        $apiKey = $gatWay->stripe_publishable_key ?? '';
        \Stripe\Stripe::setApiKey($apiKey);

        $package = Package::where('id', $request->package_id)->first();

        header('Content-Type: application/json');
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items'  => [[
                'price_data' => [
                    'currency'     => 'usd',
                    'product_data' => [
                        'name' => $package->name,
                    ],
                    'unit_amount'  => $this->calculateRealNumber($package->price),
                ],
                'quantity'   => 1,
            ]],
            'mode'        => 'payment',
            'success_url' => env('APP_URL') . '/payment/stripe-success?status=true&session_id={CHECKOUT_SESSION_ID}&package_id=' . $request->package_id,
            'cancel_url'  => env('APP_URL') . '/payment/stripe-success?status=false',
        ]);

        // dd($checkout_session);

        return Redirect::to($checkout_session->url);

        // echo '<pre>';
        // print_r($checkout_session);
        // exit;

    }

    public function stripeSuccess(Request $request)
    {
        try {
            // dd('aaaaaaaa');
            // dd($request->all());

            //transaction history
            $transaction                  = new Transaction();
            $transaction->user_id         = auth()->id();
            $transaction->package_id      = $request->package_id;
            $transaction->payment_method  = 'stripe';
            $transaction->gatway_response = $request->session_id;
            $transaction->status          = 'payment';

            //transacted package
            $package = Package::where('id', $transaction->package_id)->first();

            // dd($transaction);
            if ($transaction->save()) {
                $subscriber                 = new PackageSubscriber();
                $subscriber->user_id        = auth()->id();
                $subscriber->transaction_id = $transaction->id;
                $subscriber->package_id     = $request->package_id;
                $subscriber->amount         = $package->price;
                $subscriber->period         = $package->validity;
                $subscriber->start_date     = Carbon::now();
                $subscriber->end_date       = Carbon::now()->addDays($package->validity);
                $subscriber->save();
            }
            return view('frontend.client.stripeSuccess');

        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    // End:: stripe payment

    public function calculateRealNumber($amount)
    {
        return (($amount) * 100);
    }
}
