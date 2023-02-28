<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *      path="/profile",
     *      operationId="profile",
     *      tags={"User"},
     *      summary="Show Login user profile data",
     *      description="Show Login user profile information",
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Server error"
     *      )
     *     )
     */
    public function profile(Request $request)
    {
        try {
            if (empty(auth()->id())) {
                return response([
                    'status'  => 'error',
                    'message' => 'Unauthenticated',
                ], 401);
            }

            $target = User::where('id', auth()->id())->first();
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
     * @OA\Patch(
     ** path="/update-profile",
     *   operationId="updateProfile",
     *   tags={"User"},
     *   summary="Update user profile",
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"name", "email", "phone"},
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="email", type="text"),
     *               @OA\Property(property="phone", type="integer"),
     *               @OA\Property(property="old_password", type="password"),
     *               @OA\Property(property="password", type="password"),
     *               @OA\Property(property="password_confirmation", type="password"),
     *               @OA\Property(property="image", type="file"),
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
    public function updateProfile(Request $request)
    {
        try {
            // dd($request->all());
            $password = $oldPass = '';
            $user     = auth()->user();
            if (!empty($request->password)) {
                $password = 'min:6|confirmed|different:old_password';
                $oldPass  = [
                    'required',
                    function ($attribute, $value, $fail) use ($user) {
                        if (!Hash::check($value, $user->password)) {
                            $fail('Your password was not updated, since the provided current password does not match.');
                        }
                    },
                ];
            }
            $validate = Validator::make(request()->all(), [
                'name'         => 'required',
                'email'        => 'email:rfc,dns|unique:users,id,' . auth()->id(),
                'phone'        => 'unique:users,id,' . auth()->id(),
                'old_password' => $oldPass,
                'password'     => $password,
            ]);
            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }

            $target = User::where('id', auth()->id())->first();
            // dd($target);
            $previousFileName = $target->image;

            if (!empty($request->image)) {
                $prevfileName = 'uploads/user/' . $target->image;
                if (File::exists($prevfileName)) {
                    File::delete($prevfileName);
                }
            }
            $file = $request->file('image');
            if (!empty($file)) {
                $fileName      = uniqid() . "_" . auth()->id() . "." . $file->getClientOriginalExtension();
                $uploadSuccess = $file->move('uploads/user', $fileName);
            }

            $target->name     = $request->name ?? $target->name;
            $target->email    = $request->email ?? $target->email;
            $target->phone    = $request->phone ?? $target->phone;
            $target->image    = !empty($fileName) ? $fileName : $previousFileName;
            $target->password = !empty($request->password) ? Hash::make($request->password) : $target->password;

            if ($target->update()) {
                return response([
                    'status'  => 'success',
                    'message' => 'User updated successfully',
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
