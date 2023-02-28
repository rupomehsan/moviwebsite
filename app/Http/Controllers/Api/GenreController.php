<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Auth;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * @OA\Get(
     *      path="/genre",
     *      operationId="index",
     *      tags={"Genre"},
     *      summary="Get list of genre",
     *      description="Returns list of genre",
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
            $target = Genre::where('status', 'active')->get();
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
