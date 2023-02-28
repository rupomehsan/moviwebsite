<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MobileAd;
use Auth;
use Illuminate\Http\Request;

class AdsMobileController extends Controller
{
    /**
     * @OA\Get(
     *      path="/ads-mobile",
     *      operationId="index",
     *      tags={"Mobile Ads"},
     *      summary="Get list of Mobile Ads",
     *      description="Returns list of Mobile Ads",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="server error"
     *      )
     *     )
     */
    public function index(Request $request)
    {
        try {
            $target = MobileAd::get();
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
}
