<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use App\Models\Video;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Redirect;
use Response;
use Session;
use Validator;

class SponsorController extends Controller
{
    public function sponsorBannerIndex(Request $request)
    {
        $target = Sponsor::where('banner_type', 'image')->where('status', 'active');
        //begin filtering
        $searchText = $request->fil_search;
        if (!empty($searchText)) {
            $target->where(function ($query) use ($searchText) {
                $query->where('title', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering

        $target = $target->get();
        return view('sponsor.sponsorBannerIndex')->with(compact('target'));
    }

    public function sponsorBannerCreate(Request $request)
    {
        $view = view('sponsor.sponsorBannerCreate')->render();
        return response()->json(['html' => $view]);
    }

    public function sponsorBannerStore(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                // dd($request->all());
                $rules = [
                    'title'  => 'required',
                    'url'    => 'required',
                    'status' => Rule::in(['active', 'inactive']),
                ];

                if (($request->file_type) == "file") {
                    $rules['image'] = 'required';
                }

                if (($request->file_type) == "link") {
                    $rules['file_link'] = 'required';
                }

                $validate = Validator::make(request()->all(), $rules);

                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                if ($request->file('image')) {
                    $folder    = 'sponsor';
                    $image     = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $image->move('uploads/' . $folder, $imageName);
                    } else {
                        $image->move(public_path('/uploads/' . $folder), $imageName);
                    }
                }

                $target              = new Sponsor;
                $target->title       = $request->title;
                $target->url         = $request->url;
                $target->file_type   = $request->file_type;
                $target->file_link   = $request->file_link;
                $target->image       = $imageName ?? '';
                $target->banner_type = 'image';
                $target->status      = 'active';
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

    public function sponsorBannerEdit(Request $request)
    {
        $target = Sponsor::where('id', $request->id)->first();
        $view   = view('sponsor.sponsorBannerEdit', compact('target'))->render();
        return response()->json(['html' => $view]);
    }

    public function sponsorBannerUpdate(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'title'  => 'required',
                    'url'    => 'required',
                    'status' => Rule::in(['active', 'inactive']),
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                if ($request->file('image')) {
                    $folder    = 'sponsor';
                    $image     = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $image->move('uploads/' . $folder, $imageName);
                    } else {
                        $image->move(public_path('/uploads/' . $folder), $imageName);
                    }
                }

                $target            = Sponsor::where('id', $request->id)->first();
                $target->title     = $request->title ?? $target->title;
                $target->url       = $request->url ?? $target->url;
                $target->file_type = $request->file_type ?? $target->file_type;
                $target->file_link = $request->file_link ?? $target->file_link;
                $target->image     = $imageName ?? $target->image;

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

    public function sponsorBannerFilter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('admin/sponsor?' . $url);
    }

    //sponsor video
    public function sponsorVideoIndex(Request $request)
    {
        $target = Sponsor::where('banner_type', 'video')->where('status', 'active');
        //begin filtering
        $searchText = $request->fil_search;
        if (!empty($searchText)) {
            $target->where(function ($query) use ($searchText) {
                $query->where('title', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering

        $target = $target->get();
        return view('sponsor.sponsorVideoIndex')->with(compact('target'));
    }

    public function sponsorVideoCreate(Request $request)
    {
        $videoList = Video::where('status', 'active')->pluck('title', 'id')->toArray();
        // dd($categoryList);
        $view = view('sponsor.sponsorVideoCreate')->with(compact('videoList'))->render();
        return response()->json(['html' => $view]);
    }

    public function sponsorVideoStore(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'title'    => 'required',
                    // 'url'      => 'required',
                    // 'image'    => 'required',
                    'video_id' => 'required|not_in:0',
                    'status'   => Rule::in(['active', 'inactive']),
                ]);

                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                if ($request->file('image')) {
                    $folder    = 'sponsor';
                    $image     = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $image->move('uploads/' . $folder, $imageName);
                    } else {
                        $image->move(public_path('/uploads/' . $folder), $imageName);
                    }
                }

                $target              = new Sponsor;
                $target->title       = $request->title;
                $target->url         = $request->url;
                $target->file_type   = $request->file_type;
                $target->file_link   = $request->file_link;
                $target->image       = $imageName ?? '';
                $target->video_id    = $request->video_id;
                $target->banner_type = 'video';
                $target->status      = 'active';
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

    public function sponsorVideoEdit(Request $request)
    {
        $target    = Sponsor::where('id', $request->id)->first();
        $videoList = Video::where('status', 'active')->pluck('title', 'id')->toArray();
        $view      = view('sponsor.sponsorVideoEdit', compact('target', 'videoList'))->render();
        return response()->json(['html' => $view]);
    }

    public function sponsorVideoUpdate(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'title'    => 'required',
                    // 'url'      => 'required',
                    'video_id' => 'required|not_in:0',
                    'status'   => Rule::in(['active', 'inactive']),
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                if ($request->file('image')) {
                    $folder    = 'sponsor';
                    $image     = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $image->move('uploads/' . $folder, $imageName);
                    } else {
                        $image->move(public_path('/uploads/' . $folder), $imageName);
                    }
                }

                $target            = Sponsor::where('id', $request->id)->first();
                $target->title     = $request->title ?? $target->title;
                $target->url       = $request->url ?? $target->url;
                $target->video_id  = $request->video_id ?? $target->video_id;
                $target->file_type = $request->file_type ?? $target->file_type;
                $target->file_link = $request->file_link ?? $target->file_link;
                $target->image     = $imageName ?? $target->image;

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

    public function sponsorVideoFilter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('admin/sponsor/sponsor-video-index?' . $url);
    }

    //destroy
    public function destroy(Request $request, $posturl)
    {
        if (auth()->user()->email === 'demoadmin@movieflix.com') {
            return Response::json(['success' => false], 401);
        } else {
            $target = Sponsor::find($request->id);

            if (empty($target)) {
                Session::flash('error', 'Invalid Data Id');
            }
            $fileName = 'uploads/sponsor/' . $target->image;
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

}