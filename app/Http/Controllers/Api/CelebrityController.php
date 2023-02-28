<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Celebrity;
use Auth;
use Illuminate\Http\Request;

class CelebrityController extends Controller
{
    /**
     * @OA\Get(
     *      path="/celebrity",
     *      operationId="index",
     *      tags={"Celebrity"},
     *      summary="Get list of celebrity",
     *      description="Returns list of celebrity",
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
            $target = Celebrity::where('status', 'active')->with(['celebrity_type'])->get();
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
