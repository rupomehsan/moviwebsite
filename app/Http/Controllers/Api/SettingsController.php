<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SmtpSetting;
use App\Models\VideoSetting;
use Auth;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/basic-settings",
     *      operationId="basicSettings",
     *      tags={"Settings"},
     *      security={{"bearerAuth":{}}},
     *      summary="Basic Settings Information",
     *      description="Basic Settings Information",
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
    public function basicSettings(Request $request)
    {
        try {
            $basic = Setting::first();
            return response([
                'status' => 'success',
                'data'   => $basic,
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/video-settings",
     *      operationId="videoSettings",
     *      tags={"Settings"},
     *      security={{"bearerAuth":{}}},
     *      summary="Video Settings Information",
     *      description="Video Settings Information",
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
    public function videoSettings(Request $request)
    {
        try {
            $videoSettings = VideoSetting::with(['category', 'sub_category'])->get();
            return response([
                'status' => 'success',
                'data'   => $videoSettings,
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/setting/smtp",
     *      operationId="smtpIndex",
     *      tags={"Setting"},
     *      summary="SMTP Setting Information",
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
    public function smtpIndex(Request $request)
    {
        try {
            $target = SmtpSetting::first();
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
     ** path="/setting/smtp-update",
     *   operationId="smtpUpdate",
     *   tags={"Setting"},
     *   summary="Update SMTP Setting",
     *
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *
     *               @OA\Property(property="type", type="text"),
     *               @OA\Property(property="host", type="text"),
     *               @OA\Property(property="email", type="text"),
     *               @OA\Property(property="password", type="text"),
     *               @OA\Property(property="encryption", type="text"),
     *               @OA\Property(property="port", type="text"),
     *            ),
     *        ),
     *    ),
     *  @OA\Response(
     *      response=404,
     *      description="Bad Request"
     *   ),
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
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=500,
     *      description="Server error"
     *   )
     *)
     **/
    public function smtpUpdate(Request $request)
    {
        // dd($request->all());
        try {

            $access = User::where('id', auth()->id())->first();
            if ($access->user_role != 'admin') {
                return response([
                    'status'  => 'error',
                    'message' => 'You are not a Admin. Only amin can access this fuction.',
                ], 404);
            }

            $validate = Validator::make(request()->all(), [
                'type'       => 'required',
                'host'       => 'required',
                'email'      => 'required',
                'password'   => 'required',
                'encryption' => 'required|not_in:0',
                'port'       => 'required',
            ]);
            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }

            $setting = SmtpSetting::first();

            if (empty($setting)) {
                $setting             = new SmtpSetting;
                $setting->type       = $request->type;
                $setting->host       = $request->host;
                $setting->email      = $request->email;
                $setting->password   = $request->password;
                $setting->encryption = $request->encryption;
                $setting->port       = $request->port;
                if ($setting->save()) {
                    return response([
                        'status'  => 'success',
                        'message' => 'SMTP Settings update successfully',
                    ], 200);

                }
            } else {
                $setting->type       = $request->type ?? $setting->type;
                $setting->host       = $request->host ?? $setting->host;
                $setting->email      = $request->email ?? $setting->email;
                $setting->password   = $request->password ?? $setting->password;
                $setting->encryption = $request->encryption ?? $setting->encryption;
                $setting->port       = $request->port ?? $setting->port;
                if ($setting->update()) {
                    return response([
                        'status'  => 'success',
                        'message' => 'SMTP Settings update successfully',
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

}
