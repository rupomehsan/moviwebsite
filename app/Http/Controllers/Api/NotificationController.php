<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ManageNotification;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Response;

class NotificationController extends Controller
{
    /**
     * @OA\Get(
     *      path="/notification",
     *      operationId="index",
     *      tags={"Notification Management"},
     *      summary="All Notification data",
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
            $target = Notification::leftJoin('videos', 'videos.id', 'notifications.video_id')
                ->select('videos.title as video_title', 'notifications.created_at', 'notifications.description', 'notifications.id as notification_id')
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
     * @OA\Get(
     *      path="/notification/mobile-keys",
     *      operationId="mobileNotificationKeys",
     *      tags={"Notification Management"},
     *      summary="Mobile Notification required key and ID",
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
    public function mobileNotificationKeys(Request $request)
    {
        try {
            $target = ManageNotification::where('notification_type', 'mobile')->first();
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

    public function sendNotification(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make(request()->all(), [
            'title' => 'required',
        ]);

        if ($validate->fails()) {
            return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
        }
        $imageName = '';
        if ($request->file('image')) {
            $folder    = 'notification';
            $image     = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalName();
            if (config('app.env') === 'production') {
                $image->move('uploads/' . $folder, $imageName);
            } else {
                $image->move(public_path('/uploads/' . $folder), $imageName);
            }
        }

        $target                = new Notification;
        $target->title         = $request->title;
        $target->description   = $request->description;
        $target->image         = $imageName ?? '';
        $target->video_id      = $request->video_id;
        $target->tv_channel_id = $request->tv_channel_id;
        $target->external_link = $request->external_link;
        $target->status        = 'active';
        $target->save();

        $webConfigurations    = ManageNotification::where('notification_type', 'web')->first();
        $mobileConfigurations = ManageNotification::where('notification_type', 'mobile')->first();
        $url                  = '';
        if (!empty($request->video_id)) {
            $url = '/videoshow/' . $request->video_id;
        } elseif (!empty($request->external_link)) {
            $url = $request->external_link;
        }

        $content = array(
            "en" => $request->description,
        );

        $response = Http::withHeaders([
            'Content-Type'  => 'application/json; charset=utf-8',
            'Authorization' => 'Basic ' . ($webConfigurations->api_key ?? ''),
        ])->post('https://onesignal.com/api/v1/notifications', [
            'app_id'            => ($webConfigurations->api_id ?? ''),
            'included_segments' => array(
                'Subscribed Users',
            ),
            'data'              => array(
                "foo" => "bar",
            ),
            'headings'          => ['en' => $request->title],
            'contents'          => $content,
            'contents'          => $content,
            'url'               => $url,
        ]);
        $jsonResponse = $response->json();
        if (array_key_exists('errors', $jsonResponse)) {
            return response([
                'status' => 'validate_errors',
                'data'   => $jsonResponse,
            ]);
        } else {
            return response([
                'status' => 'success',
                'data'   => $jsonResponse,
            ]);
        }
    }
}
