<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MgtStatus;
use App\Models\TopFeature;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Response;
use Session;
use Validator;

class TopFeatureController extends Controller
{
    public function index(Request $request)
    {
        try {
            $mgtStatus = MgtStatus::where('name', 'top-feature')->first();
            $target    = TopFeature::join('videos', 'videos.id', 'top_features.video_id')
                ->select('videos.thumbnail as thumbnail', 'videos.title as title', 'top_features.id as top_features_id')
                ->get();
            return view('topFeature.index')->with(compact('target', 'mgtStatus'));
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
        $view      = view('topFeature.create')->with(compact('videoList'))->render();
        return response()->json(['html' => $view]);
    }

    public function getVideoImage(Request $request)
    {
        $videoImg = Video::where('id', $request->video_id)->first();
        $view     = view('topFeature.getVideoImage')->with(compact('videoImg'))->render();
        return response()->json(['html' => $view]);
    }

    public function store(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'video_id' => 'required|not_in:0|unique:top_features',
                ]);

                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                $target           = new TopFeature;
                $target->video_id = $request->video_id;
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

    public function edit(Request $request)
    {
        $target = TopFeature::join('videos', 'videos.id', 'top_features.video_id')
            ->where('top_features.id', $request->id)
            ->select('videos.thumbnail as thumbnail', 'videos.title as title', 'videos.id as video_id', 'top_features.id as top_features_id')
            ->first();

        // dd($target);

        $videoList = Video::where('status', 'active')->pluck('title', 'id')->toArray();

        $view = view('topFeature.edit', compact('target', 'videoList'))->render();
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

    public function update(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'video_id' => 'required|not_in:0|unique:top_features,id,' . $request->id,
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                $target           = TopFeature::where('id', $request->id)->first();
                $target->video_id = $request->video_id ?? $target->video_id;

                if ($target->update()) {
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
            $target = TopFeature::find($request->id);

            if (empty($target)) {
                Session::flash('error', 'Invalid Data Id');
            }

            if ($target->delete()) {
                return Response::json(['success' => true], 200);
            } else {
                return Response::json(['success' => false], 404);
            }
        }
    }

}