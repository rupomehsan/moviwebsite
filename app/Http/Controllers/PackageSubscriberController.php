<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageSubscriber;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Redirect;
use Response;
use Session;
use Validator;

class PackageSubscriberController extends Controller
{
    public function index(Request $request)
    {
        try {
            $target = PackageSubscriber::leftJoin('users', 'users.id', 'package_subscribers.user_id')
                ->leftJoin('packages', 'packages.id', 'package_subscribers.package_id')
                ->orderBy('start_date', 'DESC')
                ->select('users.name as user_name', 'users.email as user_email', 'packages.name as package_name'
                    , 'package_subscribers.start_date', 'package_subscribers.end_date')
                ->get();
            // dd($target);
            return view('packageSubscriber.index')->with(compact('target'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'name'     => 'required|unique:packages',
                    'validity' => 'required',
                    'price'    => 'required',
                    'status'   => Rule::in(['active', 'inactive']),
                ]);

                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                $target              = new PackageSubscriber;
                $target->name        = $request->name;
                $target->description = $request->description;
                $target->validity    = $request->validity;
                $target->price       = $request->price;
                $target->status      = 'active';
                if ($target->save()) {
                    return Response::json(['success' => true], 200);
                }
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function __construct()
    {
        if (!file_exists(base_path('vendor/licensed'))) {
            if (Route::has('/installation')) {
                return redirect('/installation');
            } else {
                abort(500);
            }
        }
    }

    public function offlineSubscriber(Request $request)
    {
        try {
            $target = PackageSubscriber::leftJoin('users', 'users.id', 'package_subscribers.user_id')
                ->leftJoin('packages', 'packages.id', 'package_subscribers.package_id')
                ->leftJoin('transactions', 'transactions.id', 'package_subscribers.transaction_id')
                ->orderBy('start_date', 'DESC')
                ->where('transactions.payment_method', 'offline')
                ->select('users.name as user_name', 'users.email as user_email', 'packages.name as package_name'
                    , 'package_subscribers.start_date', 'package_subscribers.end_date')
                ->get();
            // dd($target);
            return view('packageSubscriber.offlineSubscriber')->with(compact('target'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function offlineMakePayment(Request $request)
    {
        try {
            $user = User::where('user_role_id', '3')->pluck('name', 'id')->toArray();

            $package = Package::pluck('name', 'id')->toArray();

            // dd($package);
            return view('packageSubscriber.offlineMakePayment')->with(compact('user', 'package'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function offlineMakePaymentStore(Request $request)
    {
        try {
            // dd($request->all());

            if ($request->user_type == 'exists') {
                $validate = Validator::make(request()->all(), [
                    'user_id'    => 'required|not_in:0',
                    'package_id' => 'required|not_in:0',
                    'amount'     => 'required',
                    'start_date' => 'required',
                ]);
            }
            if ($request->user_type == 'new') {
                $validate = Validator::make(request()->all(), [
                    'name'       => 'required',
                    'email'      => 'required|unique:users|email',
                    'phone'      => 'required',
                    'package_id' => 'required|not_in:0',
                    'amount'     => 'required',
                    'start_date' => 'required',
                ]);
            }
            if ($validate->fails()) {
                return redirect('admin/offline-payment/make-payment')
                    ->withInput()
                    ->withErrors($validate);
            }

            if ($request->user_type == 'new') {

                $user                 = new User;
                $user->user_role_id   = 3;
                $user->name           = $request->name;
                $user->email          = $request->email;
                $user->phone          = $request->phone;
                $user->password       = Hash::make('123456');
                $user->account_status = 'confirmed';
                $user->status         = 'active';

                if ($user->save()) {
                    //transaction history
                    $transaction                 = new Transaction();
                    $transaction->user_id        = $user->id;
                    $transaction->package_id     = $request->package_id;
                    $transaction->payment_method = 'offline';
                    $transaction->status         = 'payment';

                    //transacted package
                    $package = Package::where('id', $transaction->package_id)->first();

                    // dd($transaction);
                    if ($transaction->save()) {
                        $subscriber                 = new PackageSubscriber();
                        $subscriber->user_id        = $user->id;
                        $subscriber->transaction_id = $transaction->id;
                        $subscriber->package_id     = $request->package_id;
                        $subscriber->amount         = $package->price;
                        $subscriber->period         = $package->validity;
                        $subscriber->start_date     = $request->start_date;
                        $subscriber->end_date       = (new Carbon($request->start_date))->addDays($package->validity);
                        if ($subscriber->save()) {
                            Session::flash('success', "Payment Successfully Done!");
                            return redirect('admin/offline-payment');
                        } else {
                            Session::flash('error', "Payment Unuccessfull!");
                            return redirect('admin/offline-payment/make-payment');
                        }
                    }
                }
            } else {
                //transaction history
                $transaction                 = new Transaction();
                $transaction->user_id        = $request->user_id;
                $transaction->package_id     = $request->package_id;
                $transaction->payment_method = 'offline';
                $transaction->status         = 'payment';

                //transacted package
                $package = Package::where('id', $transaction->package_id)->first();

                // dd($transaction);
                if ($transaction->save()) {
                    $subscriber                 = new PackageSubscriber();
                    $subscriber->user_id        = $request->user_id;
                    $subscriber->transaction_id = $transaction->id;
                    $subscriber->package_id     = $request->package_id;
                    $subscriber->amount         = $package->price;
                    $subscriber->period         = $package->validity;
                    $subscriber->start_date     = $request->start_date;
                    $subscriber->end_date       = (new Carbon($request->start_date))->addDays($package->validity);
                    if ($subscriber->save()) {
                        Session::flash('success', "Payment Successfully Done!");
                        return redirect('admin/offline-payment');
                    } else {
                        Session::flash('error', "Payment Unuccessfull!");
                        return redirect('admin/offline-payment/make-payment');
                    }
                }
            }

        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
