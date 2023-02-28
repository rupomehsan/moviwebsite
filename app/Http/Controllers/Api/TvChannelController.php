<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TvChannel;
use App\Models\TvChannelCategory;
use Auth;
use Illuminate\Http\Request;

class TvChannelController extends Controller
{
    /**
     * @OA\Get(
     *      path="/tv-channel",
     *      operationId="index",
     *      tags={"Tv Channel"},
     *      summary="Get list of Tv Channel",
     *      description="Returns list of Tv Channel",
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
            $target = TvChannelCategory::where('status', 'active')->with(['tv_channel'])->get();
            // $target = TvChannel::where('status', 'active')->with(['tv_channel_category'])->get();
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
    public function show(Request $request, $id)
    {
        try {
            $target = TvChannel::where('id', $id)->first();
            // $target = TvChannel::where('status', 'active')->with(['tv_channel_category'])->get();
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