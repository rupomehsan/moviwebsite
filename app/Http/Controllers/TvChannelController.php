<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MgtStatus;
use App\Models\TvChannel;
use App\Models\TvChannelCategory;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Redirect;
use Response;
use Session;
use Validator;

class TvChannelController extends Controller
{
    public function index(Request $request)
    {
        try {
            $mgtStatus = MgtStatus::where('name', 'tv-channel')->first();
            $target    = TvChannel::where('status', 'active');
            //begin filtering
            $searchText = $request->fil_search;
            if (!empty($searchText)) {
                $target->where(function ($query) use ($searchText) {
                    $query->where('name', 'LIKE', '%' . $searchText . '%');
                });
            }
            //end filtering

            $target = $target->get();
            // dd($target);
            return view('tv.index')->with(compact('target', 'mgtStatus'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function create(Request $request)
    {
        $streamTypeArr = [
            '.m3u8'   => '.m3u8',
            'youtube' => 'YouTube Live',
            'web'     => 'Web View',
        ];
        $categoryList = TvChannelCategory::where('status', 'active')->pluck('name', 'id')->toArray();

        $view = view('tv.create', compact('streamTypeArr', 'categoryList'))->render();
        return response()->json(['html' => $view]);
    }

    public function store(Request $request)
    {
        try {

            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                // dd($request->all());

                $rules = [
                    'name'                   => 'required|unique:tv_channels',
                    'url'                    => 'required',
                    'tv_channel_category_id' => 'required|not_in:0',
                    'stream_type'            => 'required|not_in:0',
                    'status'                 => Rule::in(['active', 'inactive']),
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
                    $folder    = 'tv';
                    $image     = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $image->move('uploads/' . $folder, $imageName);
                    } else {
                        $image->move(public_path('/uploads/' . $folder), $imageName);
                    }
                }

                $target                         = new TvChannel;
                $target->name                   = $request->name;
                $target->url                    = $request->url;
                $target->tv_channel_category_id = $request->tv_channel_category_id;
                $target->stream_type            = $request->stream_type;
                $target->file_type              = $request->file_type;
                $target->file_link              = $request->file_link;
                $target->is_parental            = $request->is_parental ?? 'off';
                $target->image                  = $imageName ?? '';
                $target->status                 = 'active';
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

    public function edit(Request $request)
    {
        $streamTypeArr = [
            '.m3u8'   => '.m3u8',
            'youtube' => 'YouTube Live',
            'web'     => 'Web View',
        ];
        $categoryList = TvChannelCategory::where('status', 'active')->pluck('name', 'id')->toArray();
        $target       = TvChannel::where('id', $request->id)->first();
        $view         = view('tv.edit', compact('target', 'streamTypeArr', 'categoryList'))->render();
        return response()->json(['html' => $view]);
    }

    public function update(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'name'                   => 'required|unique:tv_channels,id,' . $request->id,
                    'url'                    => 'required',
                    'tv_channel_category_id' => 'required|not_in:0',
                    'stream_type'            => 'required|not_in:0',
                    'status'                 => Rule::in(['active', 'inactive']),
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                if ($request->file('image')) {
                    $folder    = 'tv';
                    $image     = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $image->move('uploads/' . $folder, $imageName);
                    } else {
                        $image->move(public_path('/uploads/' . $folder), $imageName);
                    }
                }

                $target                         = TvChannel::where('id', $request->id)->first();
                $target->name                   = $request->name ?? $target->name;
                $target->url                    = $request->url ?? $target->url;
                $target->tv_channel_category_id = $request->tv_channel_category_id ?? $target->tv_channel_category_id;
                $target->stream_type            = $request->stream_type ?? $target->stream_type;
                $target->file_type              = $request->file_type ?? $target->file_type;
                $target->file_link              = $request->file_link ?? $target->file_link;
                $target->is_parental            = $request->is_parental ?? 'off';
                $target->image                  = $imageName ?? $target->image;

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
            $target = TvChannel::find($request->id);

            if (empty($target)) {
                Session::flash('error', 'Invalid Data Id');
            }

            $fileName = 'uploads/tv/' . $target->image;
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

    public function filter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('admin/tv-channel?' . $url);
    }

}