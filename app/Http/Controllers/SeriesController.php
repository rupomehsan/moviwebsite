<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Episod;
use App\Models\Season;
use App\Models\Series;
use App\Models\SeriesCategory;
use App\Models\Video;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Redirect;
use Response;
use Session;
use Validator;

class SeriesController extends Controller
{
    public function seriesIndex(Request $request)
    {
        $target = Series::leftJoin('series_categories', 'series_categories.id', 'series.series_category_id');
        //begin filtering
        $searchText = $request->fil_search;
        if (!empty($searchText)) {
            $target->where(function ($query) use ($searchText) {
                $query->where('series.name', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering

        $target = $target->select('series_categories.name as series_category_name', 'series.*')->get();
        // dd($target);

        $numberVideo = [];
        $videos      = Video::where('is_series', 'on')->get();
        if (!$videos->isEmpty()) {
            foreach ($videos as $video) {
                if (!empty($video->series_id)) {
                    $numberVideo[$video->series_id] = $numberVideo[$video->series_id] ?? '0';
                    $numberVideo[$video->series_id] += '1';
                }
            }
        }
        // dd($numberVideo);

        return view('series.seriesIndex')->with(compact('target', 'numberVideo'));
    }

    public function seriesCreate(Request $request)
    {
        $seriesCategoryList = SeriesCategory::where('status', 'active')->pluck('name', 'id')->toArray();
        $view               = view('series.seriesCreate')->with(compact('seriesCategoryList'))->render();
        return response()->json(['html' => $view]);
    }

    public function seriesStore(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'series_category_id' => 'required',
                    'name'               => 'required',
                    // 'image'              => 'required',
                    'status'             => Rule::in(['active', 'inactive']),
                ]);

                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                // if ($request->file('image')) {
                //     $folder    = 'series';
                //     $image     = $request->file('image');
                //     $imageName = time() . '.' . $image->getClientOriginalName();
                //     if (config('app.env') === 'production') {
                //         $image->move('uploads/' . $folder, $imageName);
                //     } else {
                //         $image->move(public_path('/uploads/' . $folder), $imageName);
                //     }
                // }
                $target                     = new Series;
                $target->series_category_id = $request->series_category_id;
                $target->name               = $request->name;
                // $target->image              = $imageName ?? '';
                $target->status     = 'active';
                $target->updated_by = auth()->id();
                $target->created_by = auth()->id();
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

    public function seriesEdit(Request $request)
    {
        $seriesCategoryList = SeriesCategory::where('status', 'active')->pluck('name', 'id')->toArray();
        $target             = Series::where('id', $request->id)->first();
        $view               = view('series.seriesEdit', compact('target', 'seriesCategoryList'))->render();
        return response()->json(['html' => $view]);
    }

    public function seriesUpdate(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'series_category_id' => 'required',
                    'name'               => 'required',
                    'status'             => Rule::in(['active', 'inactive']),
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                // if ($request->file('image')) {
                //     $folder    = 'series';
                //     $image     = $request->file('image');
                //     $imageName = time() . '.' . $image->getClientOriginalName();
                //     if (config('app.env') === 'production') {
                //         $image->move('uploads/' . $folder, $imageName);
                //     } else {
                //         $image->move(public_path('/uploads/' . $folder), $imageName);
                //     }
                // }

                $target                     = Series::where('id', $request->id)->first();
                $target->series_category_id = $request->series_category_id ?? $target->series_category_id;
                $target->name               = $request->name ?? $target->name;
                // $target->image              = $imageName ?? $target->image;

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

    public function filter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('admin/series?' . $url);
    }

    //season
    public function seasonView(Request $request)
    {
        $target = Season::join('series', 'series.id', 'seasons.series_id')
            ->leftJoin('series_categories', 'series_categories.id', 'series.series_category_id');
        //begin filtering
        $searchText = $request->fil_search;
        if (!empty($searchText)) {
            $target->where(function ($query) use ($searchText) {
                $query->where('name', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering

        $target = $target->select('series_categories.name as series_category_name', 'series.name as series_name', 'seasons.*')->get();

        $numberVideo = [];
        $videos      = Video::where('is_series', 'on')->get();
        if (!$videos->isEmpty()) {
            foreach ($videos as $video) {
                if (!empty($video->season_id)) {
                    $numberVideo[$video->season_id] = $numberVideo[$video->season_id] ?? '0';
                    $numberVideo[$video->season_id] += '1';
                }
            }
        }
        // dd($numberVideo);

        return view('series.seasonIndex')->with(compact('target', 'numberVideo'));
    }

    public function seasonCreate(Request $request)
    {
        $seriesList = Series::where('status', 'active')->pluck('name', 'id')->toArray();
        // dd($categoryList);
        $view = view('series.seasonCreate')->with(compact('seriesList'))->render();
        return response()->json(['html' => $view]);
    }

    public function seasonStore(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'name'      => 'required',
                    // 'image'     => 'required',
                    'series_id' => 'required|not_in:0',
                    'status'    => Rule::in(['active', 'inactive']),
                ]);

                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                // if ($request->file('image')) {
                //     $folder    = 'series';
                //     $image     = $request->file('image');
                //     $imageName = time() . '.' . $image->getClientOriginalName();
                //     if (config('app.env') === 'production') {
                //         $image->move('uploads/' . $folder, $imageName);
                //     } else {
                //         $image->move(public_path('/uploads/' . $folder), $imageName);
                //     }
                // }

                $target            = new Season;
                $target->series_id = $request->series_id;
                $target->name      = $request->name;
                // $target->image      = $imageName ?? '';
                $target->status     = 'active';
                $target->updated_by = auth()->id();
                $target->created_by = auth()->id();
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

    public function seasonEdit(Request $request)
    {
        $target     = Season::where('id', $request->id)->first();
        $seriesList = Series::where('status', 'active')->pluck('name', 'id')->toArray();
        $view       = view('series.seasonEdit', compact('target', 'seriesList'))->render();
        return response()->json(['html' => $view]);
    }

    public function seasonUpdate(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'name'   => 'required',
                    'status' => Rule::in(['active', 'inactive']),
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                // if ($request->file('image')) {
                //     $folder    = 'series';
                //     $image     = $request->file('image');
                //     $imageName = time() . '.' . $image->getClientOriginalName();
                //     if (config('app.env') === 'production') {
                //         $image->move('uploads/' . $folder, $imageName);
                //     } else {
                //         $image->move(public_path('/uploads/' . $folder), $imageName);
                //     }
                // }

                $target       = Season::where('id', $request->id)->first();
                $target->name = $request->name ?? $target->name;
                // $target->image = $imageName ?? $target->image;

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
    public function seasonFilter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('admin/series/season?' . $url);
    }

    //episod
    public function episodView(Request $request)
    {
        $target = Episod::join('seasons', 'seasons.id', 'episods.season_id')
            ->leftJoin('series', 'series.id', 'seasons.series_id')
            ->leftJoin('series_categories', 'series_categories.id', 'series.series_category_id');
        //begin filtering
        $searchText = $request->fil_search;
        if (!empty($searchText)) {
            $target->where(function ($query) use ($searchText) {
                $query->where('name', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering

        $numberVideo = [];
        $videos      = Video::where('is_series', 'on')->get();
        if (!$videos->isEmpty()) {
            foreach ($videos as $video) {
                if (!empty($video->episod_id)) {
                    $numberVideo[$video->episod_id] = $numberVideo[$video->episod_id] ?? '0';
                    $numberVideo[$video->episod_id] += '1';
                }
            }
        }
        // dd($numberVideo);

        $target = $target->select('series_categories.name as series_category_name', 'series.name as series_name', 'seasons.name as season_name', 'episods.*')->get();
        return view('series.episodIndex')->with(compact('target', 'numberVideo'));
    }

    public function episodCreate(Request $request)
    {
        $seriesList = Series::where('status', 'active')->pluck('name', 'id')->toArray();
        $view       = view('series.episodCreate')->with(compact('seriesList'))->render();
        return response()->json(['html' => $view]);
    }

    public function episodStore(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'series_id' => 'required|not_in:0',
                    'season_id' => 'required|not_in:0',
                    'name'      => 'required',
                    'number'    => 'required',
                    // 'image'     => 'required',
                    'status'    => Rule::in(['active', 'inactive']),
                ]);

                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                // if ($request->file('image')) {
                //     $folder    = 'series';
                //     $image     = $request->file('image');
                //     $imageName = time() . '.' . $image->getClientOriginalName();
                //     if (config('app.env') === 'production') {
                //         $image->move('uploads/' . $folder, $imageName);
                //     } else {
                //         $image->move(public_path('/uploads/' . $folder), $imageName);
                //     }
                // }

                $target            = new Episod;
                $target->series_id = $request->series_id;
                $target->season_id = $request->season_id;
                $target->name      = $request->name;
                $target->number    = $request->number;
                // $target->image      = $imageName ?? '';
                $target->status     = 'active';
                $target->updated_by = auth()->id();
                $target->created_by = auth()->id();
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

    public function episodEdit(Request $request)
    {
        $target     = Episod::where('id', $request->id)->first();
        $seriesList = Series::where('status', 'active')->pluck('name', 'id')->toArray();
        $seasonList = Season::where('status', 'active')->where('series_id', $target->series_id)->pluck('name', 'id')->toArray();
        $view       = view('series.episodEdit', compact('target', 'seriesList', 'seasonList'))->render();
        return response()->json(['html' => $view]);
    }

    public function getSeason(Request $request)
    {
        $seasonList = Season::where('status', 'active')->where('series_id', $request->series_id)->pluck('name', 'id')->toArray();
        $view       = view('series.getSeason', compact('seasonList'))->render();
        return response()->json(['html' => $view]);
    }

    public function episodUpdate(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'series_id' => 'required|not_in:0',
                    'season_id' => 'required|not_in:0',
                    'name'      => 'required',
                    'number'    => 'required',
                    'status'    => Rule::in(['active', 'inactive']),
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                // if ($request->file('image')) {
                //     $folder    = 'series';
                //     $image     = $request->file('image');
                //     $imageName = time() . '.' . $image->getClientOriginalName();
                //     if (config('app.env') === 'production') {
                //         $image->move('uploads/' . $folder, $imageName);
                //     } else {
                //         $image->move(public_path('/uploads/' . $folder), $imageName);
                //     }
                // }

                $target            = Episod::where('id', $request->id)->first();
                $target->series_id = $request->series_id ?? $target->series_id;
                $target->season_id = $request->season_id ?? $target->season_id;
                $target->name      = $request->name ?? $target->name;
                $target->number    = $request->number ?? $target->number;
                // $target->image     = $imageName ?? $target->image;

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

    public function episodFilter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('admin/series/episod?' . $url);
    }

    //destroy
    public function destroy(Request $request, $model)
    {
        if (auth()->user()->email === 'demoadmin@movieflix.com') {
            return Response::json(['success' => false], 401);
        } else {
            $NamespacedModel = 'App\\Models\\' . $model;
            $target          = $NamespacedModel::find($request->id);

            if (empty($target)) {
                Session::flash('error', 'Invalid Data Id');
            }
            $fileName = 'uploads/series/' . $target->image;
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