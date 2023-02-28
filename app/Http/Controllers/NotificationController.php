<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ManageNotification;
use App\Models\Notification;
use App\Models\TvChannel;
use App\Models\Video;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Response;
use Session;
use Validator;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $target = Notification::leftJoin('videos', 'videos.id', 'notifications.video_id')
                ->select('videos.title as video_title', 'notifications.created_at', 'notifications.description', 'notifications.id as notification_id')
                ->get();
            // dd($target);
            return view('notification.index')->with(compact('target'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function manageNotification(Request $request)
    {
        try {
            return view('notification.manageNotification');
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function getMobileData(Request $request)
    {
        $target = ManageNotification::where('notification_type', $request->notification_type)->first();
        $view   = view('notification.getMobileData', compact('target'))->render();
        return response()->json(['html' => $view]);
    }
    public function getWebData(Request $request)
    {
        $target = ManageNotification::where('notification_type', $request->notification_type)->first();
        $view   = view('notification.getWebData', compact('target'))->render();
        return response()->json(['html' => $view]);
    }

    public function manageNotificationUpdate(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                // dd($request->all());

                // $rules = [];
                // if ($request->notification_type == 'mobile') {
                //     $rules = [
                //         'mobile_api_key' => 'required',
                //         'mobile_api_id'  => 'required',
                //     ];
                // }
                // if ($request->notification_type == 'web') {
                //     $rules = [
                //         'web_api_key' => 'required',
                //         'web_api_id'  => 'required',
                //     ];
                // }
                // $validate = Validator::make(request()->all(), $rules);
                // if ($validate->fails()) {
                //     return redirect('admin/notification/manage-notification')
                //         ->withInput()
                //         ->withErrors($validate);
                // }
                // $target                    = new ManageNotification;
                // $target->notification_type = $request->notification_type;

                // if ($request->notification_type == 'mobile') {
                //     $target->api_key = $request->mobile_api_key;
                //     $target->api_id  = $request->mobile_api_id;
                // }

                // if ($request->notification_type == 'web') {
                //     $target->api_key = $request->web_api_key;
                //     $target->api_id  = $request->web_api_id;
                // }

                $target['mobile']['notification_type'] = 'mobile';
                $target['mobile']['api_key']           = $request->mobile_api_key ?? '';
                $target['mobile']['api_id']            = $request->mobile_api_id ?? '';
                $target['web']['notification_type']    = 'web';
                $target['web']['api_key']              = $request->web_api_key ?? '';
                $target['web']['api_id']               = $request->web_api_id ?? '';

                $prev = ManageNotification::first();
                if (!empty($prev)) {
                    ManageNotification::truncate();
                }

                if (ManageNotification::insert($target)) {
                    Session::flash('success', "Manage Notification Updated Successfully!");
                    return redirect('admin/notification/manage-notification');
                } else {
                    Session::flash('error', "Manage Notification  Update Unsuccessfull!");
                    return redirect('admin/notification/manage-notification');
                }
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function create(Request $request)
    {
        $videoList = Video::where('status', 'active')->pluck('title', 'id')->toArray();
        $tvList    = TvChannel::where('status', 'active')->pluck('name', 'id')->toArray();
        $view      = view('notification.create', compact('videoList', 'tvList'))->render();
        return response()->json(['html' => $view]);
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

    public function store(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'title'  => 'required',
                    'status' => Rule::in(['active', 'inactive']),
                ]);

                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }
                $imageName = '';
                if (!empty($request->file('image'))) {
                    $image     = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    $image->move('/uploads/notification', $imageName);
                }

                $target                = new Notification;
                $target->title         = $request->title;
                $target->description   = $request->description;
                $target->image         = $imageName ?? '';
                $target->video_id      = $request->video_id;
                $target->tv_channel_id = $request->tv_channel_id;
                $target->external_link = $request->external_link;
                $target->status        = 'active';
                // $target->updated_by = auth()->id();
                // $target->created_by = auth()->id();
                if ($target->save()) {
                    return Response::json(['success' => true], 200);
                }
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        if (auth()->user()->email === 'demoadmin@movieflix.com') {
            return Response::json(['success' => false], 401);
        } else {
            $target = Notification::find($request->id);

            if (empty($target)) {
                Session::flash('error', 'Invalid Data Id');
            }

            $fileName = 'uploads/notification/' . ($target->image ?? '');
            if (File::exists($fileName)) {
                File::delete($fileName);
            }

            if ($target->delete()) {
                return Response::json(['success' => true], 200);
            } else {
                return Response::json(['success' => false], 404);
            }
        }
    }

    public function sendNotification2(Request $request)
    {

        $content = array(
            "en" => $request->description,
        );
        $message      = 'dkjshfdfsh dfjskldsahfds';
        $hashes_array = array();
        array_push($hashes_array, array(
            "id"   => "like-button",
            "text" => "Like",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url"  => "https://yoursite.com",
        ));
        array_push($hashes_array, array(
            "id"   => "like-button-2",
            "text" => "Like2",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url"  => "https://yoursite.com",
        ));
        $response = Http::withHeaders([
            'Content-Type'  => 'application/json; charset=utf-8',
            'Authorization' => 'Basic ' . env("ONESIGNAL_REST_API_KEY"),
        ])->post('https://onesignal.com/api/v1/notifications', [
            'app_id'            => env("ONESIGNAL_APP_ID"),
            'included_segments' => array(
                'Subscribed Users',
            ),
            // 'data'              => array(
            //     "foo" => "bar",
            // ),
            'headings'          => ['en' => $request->title],
            'contents'          => $content,
            'url'               => 'www.google.com',
            // 'web_buttons'       => $hashes_array,
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
    public function sendNotification(Request $request)
    {

        $validate = Validator::make(request()->all(), [
            'title' => 'required',
        ]);

        if ($validate->fails()) {
            return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
        }
        $imageName = '';
        if (!empty($request->file('image'))) {
            $image     = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move('/uploads/notification', $imageName);
        }

        $target                = new Notification;
        $target->title         = $request->title;
        $target->description   = $request->description;
        $target->image         = $imageName ?? '';
        $target->video_id      = $request->video_id;
        $target->tv_channel_id = $request->tv_channel_id;
        $target->external_link = $request->external_link;
        $target->status        = 'active';
        // $target->updated_by = auth()->id();
        // $target->created_by = auth()->id();
        $target->save();

        $content = array(
            "en" => $request->description,
        );
        $hashes_array = array();
        array_push($hashes_array, array(
            "id"   => "like-button",
            "text" => "Like",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url"  => "https://yoursite.com",
        ));
        array_push($hashes_array, array(
            "id"   => "like-button-2",
            "text" => "Like2",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url"  => "https://yoursite.com",
        ));
        $response = Http::withHeaders([
            'Content-Type'  => 'application/json; charset=utf-8',
            'Authorization' => 'Basic ' . env("ONESIGNAL_REST_API_KEY"),
        ])->post('https://onesignal.com/api/v1/notifications', [
            'app_id'            => env("ONESIGNAL_APP_ID"),
            'included_segments' => array(
                'Subscribed Users',
            ),
            // 'data'              => array(
            //     "foo" => "bar",
            // ),
            'headings'          => ['en' => $request->title],
            'contents'          => $content,
            'contents'          => $content,
            'url'               => 'www.google.com',
            // 'web_buttons'       => $hashes_array,
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