<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * @OA\Get(
     *      path="/country",
     *      operationId="index",
     *      tags={"Country"},
     *      summary="Get list of Country",
     *      description="Returns list of Country",
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
            $target = Country::where('status', 'active')->get();
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
     ** path="/comment",
     *   operationId="store",
     *   tags={"Comment"},
     *      security={{"bearerAuth":{}}},
     *   summary="Add a new Comment",
     *
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"video_id", "comment"},
     *               @OA\Property(property="video_id", type="int"),
     *               @OA\Property(property="comment", type="text"),
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
    public function store(Request $request)
    {
        try {
            $validate = Validator::make(request()->all(), [
                'video_id' => 'required',
                'comment'  => 'required',
            ]);

            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }
            $target             = new Comment;
            $target->video_id   = $request->video_id;
            $target->comment    = $request->comment;
            $target->status     = 'active';
            $target->updated_by = auth()->id();
            $target->created_by = auth()->id();
            if ($target->save()) {
                return response([
                    'status'  => 'success',
                    'message' => 'Comment Add Successfully',
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
