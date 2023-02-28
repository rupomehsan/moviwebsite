<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SendVerificationCode;
use App\Models\ForgotPasswordCode;
use App\Models\ForgotPasswordRequest;
use App\Models\SmtpSetting;
use App\Models\User;
use App\Models\UserVerification;
use Auth;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'], ['only' => ['logout', 'me', 'update']]);
    }

    /**
     * @OA\Post(
     ** path="/auth/register",
     *   operationId="register",
     *   tags={"Auth"},
     *   summary="Register new user",
     *
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"name", "password", "password_confirmation", "phone", "email"},
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="password", type="password"),
     *               @OA\Property(property="password_confirmation", type="password"),
     *               @OA\Property(property="phone", type="int")
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
    public function register(Request $request)
    {
        try {
            // dd(request()->all());
            $validate = Validator::make(request()->all(), [
                'name'     => 'required',
                'email'    => 'required|unique:users|email:rfc,dns',
                'phone'    => 'required|unique:users',
                'password' => 'min:6|required',
            ]);
            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }

            $user                 = new User;
            $user->user_role_id   = 3;
            $user->name           = $request->name;
            $user->email          = $request->email;
            $user->password       = Hash::make($request->password);
            $user->phone          = $request->phone;
            $user->image          = '';
            $user->account_status = 'pending';
            $user->status         = 'active';
            if ($user->save()) {

                $prevVer = UserVerification::where('email', $request->email)->first();
                if (!empty($prevVer)) {
                    $prevVer->delete();
                }

                $userVeri                    = new UserVerification;
                $userVeri->email             = $user->email;
                $userVeri->verification_code = $this->generateRandomString(6);

                if ($userVeri->save()) {
                    $smtpSettings = SmtpSetting::first();
                    config([
                        'mail.default'                 => 'smtp',
                        'mail.mailers.smtp.host'       => $smtpSettings->host ?? '',
                        'mail.mailers.smtp.port'       => $smtpSettings->port ?? '',
                        'mail.mailers.smtp.encryption' => $smtpSettings->encryption ?? '',
                        'mail.mailers.smtp.username'   => $smtpSettings->email ?? '',
                        'mail.mailers.smtp.password'   => $smtpSettings->password ?? '',
                    ]);
                    Mail::to($request->email)->send(new SendVerificationCode($userVeri->verification_code));

                    return response([
                        'status'            => 'success',
                        'message'           => 'Account verification code send your email, please check your email.',
                        'email'             => $user->email,
                        'verification_code' => $userVeri->verification_code,
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

    /**
     * @OA\Post(
     ** path="/auth/phone-verification",
     *   operationId="phoneVerification",
     *   tags={"Auth"},
     *   summary="Email verification using verfication code which sending your email.",
     *
     *
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"email","verification_code"},
     *               @OA\Property(property="email", type="int"),
     *               @OA\Property(property="verification_code", type="int"),
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

    public function phoneVerification(Request $request)
    {
        try {

            $validate = Validator::make(request()->all(), [
                'verification_code' => 'required|numeric|digits:6',
            ]);
            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }

            $code = UserVerification::where('email', $request->email)->first();
            if (empty($code)) {
                return response([
                    'status'  => 'error',
                    'message' => 'No code found.',
                ], 404);
            }

            //validation expire check
            if (($code->updated_at->addHour(1)) < (now())) {
                return response([
                    'status'  => 'error',
                    'message' => 'Your code is expired! Please resend code.',
                ], 404);
            }

            if (($code->verification_code) == ($request->verification_code)) {
                $target                 = User::where('email', $request->email)->first();
                $target->account_status = "confirmed";
                // dd($code);
                if ($target->update()) {
                    $code->delete();
                    return response([
                        'status'  => 'success',
                        'message' => 'Account verified!',
                    ], 200);
                }

            }
            return response([
                'status'  => 'error',
                'message' => 'Code not matched',
            ], 404);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Patch(
     ** path="/auth/resend-code-verification",
     *   operationId="resendCode",
     *   tags={"Auth"},
     *   summary="Resend email verfication code which can use email validation.",
     *
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=500,
     *      description="Server error"
     *   )
     *)
     **/
    public function resendCodeVerification(Request $request)
    {
        try {

            // dd($request->email);
            $target = UserVerification::where('email', $request->email)->first();
            if (empty($target)) {
                return response([
                    'status'  => 'error',
                    'message' => 'No code found.',
                ], 404);
            }
            $target->verification_code = $this->generateRandomString(6);
            if ($target->update()) {
                $smtpSettings = SmtpSetting::first();
                config([
                    'mail.default'                 => 'smtp',
                    'mail.mailers.smtp.host'       => $smtpSettings->host ?? '',
                    'mail.mailers.smtp.port'       => $smtpSettings->port ?? '',
                    'mail.mailers.smtp.encryption' => $smtpSettings->encryption ?? '',
                    'mail.mailers.smtp.username'   => $smtpSettings->email ?? '',
                    'mail.mailers.smtp.password'   => $smtpSettings->password ?? '',
                ]);
                Mail::to($request->email)->send(new SendVerificationCode($target->verification_code));
                return response([
                    'status'  => 'success',
                    'message' => 'code send your email, please check your email.',
                    'email'   => $target->email,
                    'code'    => $target->verification_code,
                ]);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @OA\Patch(
     ** path="/auth/resend-code",
     *   operationId="resendCode",
     *   tags={"Auth"},
     *   summary="Resend email verfication code which can use email validation.",
     *
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=500,
     *      description="Server error"
     *   )
     *)
     **/
    public function resendCode(Request $request)
    {
        try {
            // dd($request->email);
            $target = ForgotPasswordCode::where('email', $request->email)->first();
            if (empty($target)) {
                return response([
                    'status'  => 'error',
                    'message' => 'No code found.',
                ], 404);
            }
            $target->verification_code = $this->generateRandomString(6);
            if ($target->update()) {
                $smtpSettings = SmtpSetting::first();
                config([
                    'mail.default'                 => 'smtp',
                    'mail.mailers.smtp.host'       => $smtpSettings->host ?? '',
                    'mail.mailers.smtp.port'       => $smtpSettings->port ?? '',
                    'mail.mailers.smtp.encryption' => $smtpSettings->encryption ?? '',
                    'mail.mailers.smtp.username'   => $smtpSettings->email ?? '',
                    'mail.mailers.smtp.password'   => $smtpSettings->password ?? '',
                ]);
                Mail::to($request->email)->send(new SendVerificationCode($target->verification_code));
                return response([
                    'status'  => 'success',
                    'message' => 'code send your email, please check your email.',
                    'email'   => $target->email,
                ]);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @OA\Post(
     *      path="/auth/login",
     *      operationId="login",
     *      tags={"Auth"},
     *      summary="This api work for login this project",
     *      description="Returns list of projects",
     *
     *
     *
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"email", "password"},
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="password", type="password"),
     *            ),
     *        ),
     *    ),
     *
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *            @OA\Property(
     *              property="status",
     *              type="string",
     *              description = "success"
     *            ),
     *            @OA\Property(
     *              property="message",
     *              type="string",
     *              description = "success message"
     *            ),
     *          )
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Aothenticaton error"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Phone verification pending"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="server error"
     *      ),
     *     )
     */
    public function login()
    {
        try {
            $validator = Validator::make(request()->all(), [
                'email'    => 'required|exists:users',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response([
                    'status' => 'validate_error',
                    'data'   => $validator->errors(),
                ], 422);
            }
            if (!auth()->attempt($validator->validated())) {
                return response([
                    'status'  => 'error',
                    'message' => "Credentials doesn't matched...",
                ], 401);
            }

            if ((auth()->user()->status) == 'pending') {
                return response([
                    'status'  => 'error',
                    'message' => 'Please verified your phone.',
                ], 404);
            }

            $accessToken = auth()->user()->createToken('authToken');

            return response([
                'status'  => 'success',
                'message' => 'Successfully logged in...',
                'data'    => [
                    'token' => 'Bearer ' . $accessToken->plainTextToken,
                    'user'  => auth()->user(),
                ],
            ], 200);
        } catch (Exception $e) {
            return response([
                'status'  => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Post(
     ** path="/auth/logout",
     *   operationId="logout",
     *   tags={"Auth"},
     *   security={{"bearerAuth":{}}},
     *   summary="Logg out from this application.",
     *
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success"
     *   ),
     *   @OA\Response(
     *      response=500,
     *      description="Server error"
     *   )
     *)
     **/

    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return response([
                'status'  => 'done',
                'message' => 'Successfully logout...',
            ], 200);
        } catch (Exception $e) {
            return response([
                'status'  => 'serverError',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @OA\Post(
     ** path="/auth/forgot-password",
     *   operationId="forgotPassword",
     *   tags={"Auth"},
     *   summary="Send email verfication code which can use verify, you are a valid user.",
     *
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=500,
     *      description="Server error"
     *   )
     *)
     **/
    public function forgotPassword(Request $request)
    {
        try {
            // dd($request->email);
            $user = User::where('email', $request->email)->first();
            if (empty($user)) {
                return response([
                    'status'  => 'error',
                    'message' => 'No user found with this number.',
                ], 404);
            }

            $prevCode = ForgotPasswordCode::where('email', $request->email)->first();
            if (!empty($prevCode)) {
                $prevCode->delete();
            }

            $prevRequest = ForgotPasswordRequest::where('email', $request->email)->first();
            if (!empty($prevRequest)) {
                $prevRequest->delete();
            }

            $code                    = new ForgotPasswordCode;
            $code->email             = $request->email;
            $code->verification_code = $this->generateRandomString(6);

            $forgotRequest         = new ForgotPasswordRequest;
            $forgotRequest->email  = $request->email;
            $forgotRequest->status = 'request';

            if (($code->save()) && ($forgotRequest->save())) {

                $smtpSettings = SmtpSetting::first();
                config([
                    'mail.default'                 => 'smtp',
                    'mail.mailers.smtp.host'       => $smtpSettings->host ?? '',
                    'mail.mailers.smtp.port'       => $smtpSettings->port ?? '',
                    'mail.mailers.smtp.encryption' => $smtpSettings->encryption ?? '',
                    'mail.mailers.smtp.username'   => $smtpSettings->email ?? '',
                    'mail.mailers.smtp.password'   => $smtpSettings->password ?? '',
                ]);
                Mail::to($request->email)->send(new SendVerificationCode($code->verification_code));
                return response([
                    'status'            => 'success',
                    'message'           => 'code send your email, please check your email.',
                    'email'             => $code->email,
                    'verification_code' => $code->verification_code,
                ]);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @OA\Post(
     ** path="/auth/user-verify",
     *   operationId="UserVerify",
     *   tags={"Auth"},
     *   summary="user verify using verfication code which sending your email.",
     *
     *
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"email","verification_code"},
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="verification_code", type="int"),
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

    public function UserVerify(Request $request)
    {
        try {
            // dd($request->all());

            $validate = Validator::make(request()->all(), [
                'verification_code' => 'required|numeric|digits:6',
            ]);
            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }

            $code = ForgotPasswordCode::where('email', $request->email)->first();
            if (empty($code)) {
                return response([
                    'status'  => 'error',
                    'message' => 'No code found.',
                ], 404);
            }

            //validation expire check
            if (($code->updated_at->addHour(1)) < (now())) {
                return response([
                    'status'  => 'error',
                    'message' => 'Your code is expired! Please resend code.',
                ], 404);
            }

            if (($code->verification_code) == ($request->verification_code)) {
                $forgotRequest         = ForgotPasswordRequest::where('email', $request->email)->first();
                $forgotRequest->status = "matched";
                if ($forgotRequest->update()) {

                    $code->delete();
                    return response([
                        'status'  => 'success',
                        'message' => 'User verified. Go forword for next step.',
                    ], 200);
                }

            }
            return response([
                'status'  => 'error',
                'message' => 'Code not matched',
            ], 404);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Patch(
     ** path="/auth/change-password",
     *   operationId="changePassword",
     *   tags={"Auth"},
     *   summary="User changed his profile",
     *
     *  @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"email","password", "password_confirmation"},
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="password", type="password"),
     *               @OA\Property(property="password_confirmation", type="password"),
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
    public function changePassword(Request $request)
    {
        try {
            // dd(request()->all());
            $validate = Validator::make(request()->all(), [
                'email'                 => 'required',
                'password'              => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
            ]);

            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }

            $forgotRequest = ForgotPasswordRequest::where('email', $request->email)->first();

            if ($forgotRequest->status != 'matched') {
                return response([
                    'status'  => 'error',
                    'message' => 'You have no access to change password. please do before step again.',
                ], 404);
            }

            $target           = User::where('email', $request->email)->first();
            $target->password = Hash::make($request->password);

            $forgotRequest->status = 'changed';

            if (($target->update()) && ($forgotRequest->update())) {
                return response([
                    'status'  => 'success',
                    'message' => "Password successfully changed!",
                ], 200);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function generateRandomString($length)
    {
        $characters       = '0123456789';
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function socialLogin(Request $request)
    {
        try {
            $validate = Validator::make(request()->all(), [
                'provider' => 'required|in:google,facebook',
            ]);
            if ($validate->fails()) {
                return response([
                    'status' => 'validate_error',
                    'data'   => $validate->errors(),
                ], 422);
            }
            // dd('ok');

            $prevUser = User::where('email', $request->email)->first();
            if (empty($prevUser)) {
                $password              = $this->generateRandomString(10);
                $user                  = new User;
                $user->user_role_id    = 3;
                $user->name            = $request->name;
                $user->email           = $request->email;
                $user->provider_userid = $request->userid;
                $user->login_provider  = $request->provider;
                $user->password        = Hash::make($password);
                $user->phone           = $request->phone;
                $user->image           = $request->image;
                $user->account_status  = 'confirmed';
                $user->status          = 'active';
                if ($user->save()) {
                    if (!auth()->attempt(['email' => $user->email, 'password' => $password])) {
                        return response([
                            'status'  => 'error',
                            'message' => "Credentials doesn't matched...",
                        ], 401);
                    }

                    $accessToken = auth()->user()->createToken('authToken');

                    return response([
                        'status'  => 'success',
                        'message' => 'Successfully logged in...',
                        'data'    => [
                            'token' => 'Bearer ' . $accessToken->plainTextToken,
                            'user'  => auth()->user(),
                        ],
                    ], 200);
                }
            } else {

                $accessToken = $prevUser->createToken('authToken');

                return response([
                    'status'  => 'success',
                    'message' => 'Successfully logged in...',
                    'data'    => [
                        'token' => 'Bearer ' . $accessToken->plainTextToken,
                        'user'  => $prevUser,
                    ],
                ], 200);
            }
        } catch (Exception $e) {
            return response([
                'status'  => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
