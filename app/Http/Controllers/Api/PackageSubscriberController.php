<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageSubscriber;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Validator;

class PackageSubscriberController extends Controller
{
    /**
     * @OA\Get(
     *      path="/package-subscriber",
     *      operationId="index",
     *      tags={"Package Subscriber Management"},
     *      summary="All Package Subscriber data",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Server error"
     *      )
     *     )
     */
    public function index(Request $request)
    {
        try {
            $target = PackageSubscriber::leftJoin('users', 'users.id', 'package_subscribers.user_id')
                ->leftJoin('packages', 'packages.id', 'package_subscribers.package_id')
                ->select('users.email as user_email', 'packages.name as package_name'
                    , (DB::raw("DATE_FORMAT(package_subscribers.created_at, '%d %b %Y') as start_date")))
                ->get();
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

    /**
     * @OA\Post(
     ** path="/package-subscriber",
     *   operationId="packageSubscriber",
     *   tags={"Package Subscriber Management"},
     *   summary="Add a new Package Subscriber",
     *
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"user_id", "package_id", "payment_method"},
     *               @OA\Property(property="user_id", type="text"),
     *               @OA\Property(property="package_id", type="text"),
     *               @OA\Property(property="payment_method", type="text"),
     *               @OA\Property(property="response", type="text"),
     *               @OA\Property(property="status", type="text"),
     *            ),
     *        ),
     *    ),
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *  @OA\Response(
     *      response=404,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=422,
     *      description="Validation error"
     *   ),
     *   @OA\Response(
     *      response=500,
     *      description="Server error"
     *   )
     *)
     **/
    public function packageSubscriber(Request $request)
    {
        try {
            $validate = Validator::make(request()->all(), [
                'user_id'        => 'required',
                'package_id'     => 'required',
                'payment_method' => 'required|in:stripe,paypal',
                // 'status'         => 'in:active,inactive',
            ]);
            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }

            // $packageSubscriber                 = new PackageSubscriber;
            // $packageSubscriber->user_id        = $request->user_id;
            // $packageSubscriber->package_id     = $request->package_id;
            // $packageSubscriber->payment_method = $request->payment_method;
            // $packageSubscriber->response       = $request->response;
            // $packageSubscriber->status         = 'active';

            //transaction history
            $transaction                  = new Transaction();
            $transaction->user_id         = auth()->id();
            $transaction->package_id      = $request->package_id;
            $transaction->payment_method  = $request->payment_method;
            $transaction->gatway_response = $request->response;
            $transaction->status          = 'payment';

            //transacted package
            $package = Package::where('id', $transaction->package_id)->first();
            if (empty($package)) {
                return response([
                    'status'  => 'error',
                    'message' => 'No Package are available.',
                ], 404);
            }

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

                if ($subscriber->save()) {
                    return response([
                        'status'  => 'success',
                        'message' => 'Package Subscriber Create Successfully',
                    ], 200);

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

    /**
     * @OA\Get(
     *      path="/package-subscriber/my-subscription",
     *      operationId="mySubscription",
     *      tags={"Package Subscriber Management"},
     *      summary="Find specific Package Subscriber",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Server error"
     *      )
     *     )
     */
    public function mySubscription(Request $request)
    {
        try {
            $target = PackageSubscriber::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->first();
            $packageInfo = '';
            if (!empty($target)) {
                $packageInfo = Package::where('id', $target->package_id)->first();
            }

            $subscriptionInfo     = [];
            $subscriptionInfoData = null;
            if (!empty($packageInfo) && !empty($target)) {
                $subscriptionInfo['package_name']  = $packageInfo->name;
                $subscriptionInfo['package_price'] = $packageInfo->price;
                $subscriptionInfo['start_date']    = $target->created_at->format('j F Y');
                $subscriptionInfo['end_date']      = $packageInfo->created_at->addDays($packageInfo->validity)->format('j F Y');
            }

            // dd($subscriptionInfo);

            return response([
                'status' => 'success',
                'data'   => !empty($subscriptionInfo) ? $subscriptionInfo : $subscriptionInfoData,
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
