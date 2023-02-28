<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Celebrity;
use App\Models\Country;
use App\Models\Episod;
use App\Models\FavoriteVideo;
use App\Models\Genre;
use App\Models\ImdbKey;
use App\Models\RequestMovie;
use App\Models\Season;
use App\Models\Series;
use App\Models\SeriesCategory;
use App\Models\SubCategory;
use App\Models\Video;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Redirect;
use Response;
use Session;
use Validator;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $existImdbKey = ImdbKey::first();
        $target       = Video::where('status', 'active');
        //begin filtering
        $searchText = $request->fil_search;
        if (!empty($searchText)) {
            $target->where(function ($query) use ($searchText) {
                $query->where('title', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering

        $target = $target->get();
        return view('video.index')->with(compact('existImdbKey', 'target'));
    }

    public function storeImdbKey(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                // dd($request->all());
                $rules = [
                    'key' => 'required',
                ];

                $validate = Validator::make(request()->all(), $rules);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }
                $existKey = ImdbKey::first();
                if (!empty($existKey)) {
                    $existKey->key = $request->key ?? $existKey->key;
                    if ($existKey->update()) {
                        return Response::json(['success' => true], 200);
                    }
                } else {
                    $target      = new ImdbKey;
                    $target->key = $request->key;
                    if ($target->save()) {
                        return Response::json(['success' => true], 200);
                    }
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
        $categoryList       = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        $countryList        = Country::where('status', 'active')->pluck('name', 'id')->toArray();
        $celebrityList      = Celebrity::where('status', 'active')->pluck('name', 'id')->toArray();
        $genreList          = Genre::where('status', 'active')->pluck('name', 'id')->toArray();
        $seriesCategoryList = SeriesCategory::where('status', 'active')->pluck('name', 'id')->toArray();
        $seriesList         = Series::where('status', 'active')->pluck('name', 'id')->toArray();
        $target             = Video::get();
        return view('video.create')->with(compact('target', 'categoryList', 'countryList', 'celebrityList', 'genreList', 'seriesList', 'seriesCategoryList'));
    }

    public function getSubCategory(Request $request)
    {
        $subCategoryList = SubCategory::where('category_id', $request->category_id)->pluck('name', 'id')->toArray();
        $view            = view('video.getSubCategory', compact('subCategoryList'))->render();
        return response()->json(['html' => $view]);
    }

    public function getSeries(Request $request)
    {
        $seriesList = Series::where('series_category_id', $request->series_category_id)->pluck('name', 'id')->toArray();
        $view       = view('video.getSeries', compact('seriesList'))->render();
        return response()->json(['html' => $view]);
    }

    public function getSeason(Request $request)
    {
        $seasonList = Season::where('series_id', $request->series_id)->pluck('name', 'id')->toArray();
        $view       = view('video.getSeason', compact('seasonList'))->render();
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

    public function getEpisod(Request $request)
    {
        $episodList = Episod::where('season_id', $request->season_id)->pluck('name', 'id')->toArray();
        $view       = view('video.getEpisod', compact('episodList'))->render();
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
                    'category_id'        => 'required|not_in:0',
                    'title'              => 'required',
                    'year'               => 'required|numeric',
                    'duration'           => 'required|numeric',
                    'video_type'         => 'required|not_in:0',
                    'thumbnail'          => 'required',
                    'thumbnail_vertical' => 'required',
                    'description'        => 'required',
                    'status'             => Rule::in(['active', 'inactive']),
                ];
                if (($request->video_type) == "4") {
                    $rules['video'] = 'required';
                } else {
                    $rules['url'] = 'required';
                }

                if (($request->is_series) == "on") {
                    $rules['series_category_id'] = 'required|not_in:0';
                    $rules['series_id']          = 'required|not_in:0';
                    $rules['season_id']          = 'required|not_in:0';
                    $rules['episod_id']          = 'required|not_in:0';
                }

                $validate = Validator::make(request()->all(), $rules);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                $imageName = $imageNameVer = $videoName = '';
                // start:: image upload
                if ($request->file('thumbnail')) {
                    $folder    = 'video/thumbnail';
                    $image     = $request->file('thumbnail');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $image->move('uploads/' . $folder, $imageName);
                    } else {
                        $image->move(public_path('/uploads/' . $folder), $imageName);
                    }
                }
                // end:: image upload

                // start:: vertical image upload
                if ($request->file('thumbnail_vertical')) {
                    $folderVer    = 'video/thumbnail';
                    $imageVer     = $request->file('thumbnail_vertical');
                    $imageNameVer = time() . '.' . $imageVer->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $imageVer->move('uploads/' . $folderVer, $imageNameVer);
                    } else {
                        $imageVer->move(public_path('/uploads/' . $folderVer), $imageNameVer);
                    }
                }
                // end:: vertical image upload

                // start:: video upload
                // if (!empty($request->file('video'))) {
                //     $video     = $request->file('video');
                //     $videoName = time() . '.' . $video->getClientOriginalName();
                //     $video->move('/uploads/video', $videoName);
                // }
                if ($request->file('video')) {
                    $folderVideo = 'video';
                    $video       = $request->file('video');
                    $videoName   = time() . '.' . $video->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $video->move('uploads/' . $folderVideo, $videoName);
                    } else {
                        $video->move(public_path('/uploads/' . $folderVideo), $videoName);
                    }
                }
                // end:: video upload

                //Start::TMDB Rating
                if (!empty($request->imdb_id)) {
                    $tmdbKey    = ImdbKey::first();
                    $tmdbRating = Http::get(
                        "https://api.themoviedb.org/3/" . $request->tmdb_type . "/" . $request->imdb_id . "?api_key=" . $tmdbKey->key
                    );
                    $tmdbRating = $tmdbRating->json();
                }
                // return response()->json($tmdbRating);

                //End::TMDB Rating

                $target                     = new Video;
                $target->category_id        = $request->category_id;
                $target->sub_category_id    = $request->sub_category_id;
                $target->title              = $request->title;
                $target->year               = $request->year;
                $target->duration_hour      = $request->duration_hour;
                $target->duration           = $request->duration;
                $target->duration_sec       = $request->duration_sec;
                $target->video_type         = $request->video_type;
                $target->url                = $request->url;
                $target->slug               = $request->slug;
                $target->type               = $request->type;
                $target->trailer            = $request->trailer;
                $target->video              = $videoName ?? '';
                $target->thumbnail          = $imageName ?? '';
                $target->thumbnail_vertical = $imageNameVer ?? '';
                $target->video_on_off       = $request->video_on_off ?? 'off';
                $target->send_notification  = $request->send_notification ?? 'off';
                $target->comment_on_off     = $request->comment_on_off ?? 'off';
                $target->is_trending        = $request->is_trending ?? 'off';
                $target->fake_view          = $request->fake_view;
                $target->is_parental        = $request->is_parental ?? 'off';
                $target->is_series          = $request->is_series ?? 'off';
                $target->series_category_id = $request->series_category_id;
                $target->series_id          = $request->series_id;
                $target->season_id          = $request->season_id;
                $target->episod_id          = $request->episod_id;
                $target->description        = $request->description;
                $target->country_id         = json_encode($request->country_id);
                $target->celebrity_id       = json_encode($request->celebrity_id);
                $target->genre_id           = json_encode($request->genre_id);
                $target->director           = $request->director;
                $target->writer             = $request->writer;
                $target->tmdb_type          = $request->tmdb_type;
                $target->imdb_id            = $request->imdb_id;
                $target->tmdb_rating        = !empty($tmdbRating['vote_average']) ? $tmdbRating['vote_average'] : '';
                $target->show_tmdb          = $request->show_tmdb;
                $target->seo_title          = $request->seo_title;
                $target->meta_description   = $request->meta_description;
                $target->focus_keyword      = $request->focus_keyword;
                $target->seo_tag            = $request->seo_tag;
                $target->status             = 'active';
                $target->updated_by         = auth()->id();
                $target->created_by         = auth()->id();
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

    public function edit(Request $request, $id)
    {
        $categoryList = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        $countryList  = Country::where('status', 'active')->pluck('name', 'id')->toArray();
        // dd($countryList);
        $celebrityList      = Celebrity::where('status', 'active')->pluck('name', 'id')->toArray();
        $genreList          = Genre::where('status', 'active')->pluck('name', 'id')->toArray();
        $seriesCategoryList = SeriesCategory::where('status', 'active')->pluck('name', 'id')->toArray();
        $target             = Video::where('id', $id)->first();
        $seriesList         = Series::where('series_category_id', $target->series_category_id)->pluck('name', 'id')->toArray();
        $seasonList         = Season::where('series_id', $target->series_id)->pluck('name', 'id')->toArray();
        $episodList         = Episod::where('season_id', $target->season_id)->pluck('name', 'id')->toArray();
        $subCategoryList    = SubCategory::where('status', 'active')->where('category_id', $target->category_id)->pluck('name', 'id')->toArray();
        $prevCountry        = json_decode($target->country_id);
        $prevCelebrity      = json_decode($target->celebrity_id);
        $prevGenre          = json_decode($target->genre_id);
        // dd($prevCountry);exit;
        return view('video.edit')->with(compact('target', 'categoryList', 'countryList', 'celebrityList', 'genreList', 'subCategoryList'
            , 'seriesCategoryList', 'seriesList', 'seasonList', 'episodList', 'prevCountry', 'prevCelebrity', 'prevGenre'));
    }

    public function update(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                // dd($request->all());
                $rules = [
                    'category_id' => 'required|not_in:0',
                    'title'       => 'required',
                    'year'        => 'required|numeric',
                    'duration'    => 'required|numeric',
                    'video_type'  => 'required|not_in:0',
                    'description' => 'required',
                    'status'      => Rule::in(['active', 'inactive']),
                ];
                if (($request->video_type) == "4") {
                } else {
                    $rules['url'] = 'required';
                }

                if (($request->is_series) == "on") {
                    $rules['series_id'] = 'required|not_in:0';
                    $rules['season_id'] = 'required|not_in:0';
                    $rules['episod_id'] = 'required|not_in:0';
                }
                // $seasonName = '';
                // if ((($request->is_series) == "on") && (($request->is_new_season) == "yes")) {
                //     $rules['season_name'] = 'required';
                //     $seasonName           = $request->season_name;
                // }
                // if ((($request->is_series) == "on") && (($request->is_new_season) == "no")) {
                //     $rules['season'] = 'required|not_in:0';
                //     $seasonName      = $request->season;
                // }

                $validate = Validator::make(request()->all(), $rules);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                // start:: image upload
                if (!empty($request->file('thumbnail'))) {
                    $image     = $request->file('thumbnail');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    // $image->move('/uploads/video/thumbnail', $imageName);
                    if (config('app.env') === 'production') {
                        $image->move('uploads/video/thumbnail', $imageName);
                    } else {
                        $image->move(public_path('/uploads/video/thumbnail'), $imageName);
                    }
                }
                // end:: image upload

                // start:: vertical image upload
                if (!empty($request->file('thumbnail_vertical'))) {
                    $image        = $request->file('thumbnail_vertical');
                    $imageNameVer = time() . '.' . $image->getClientOriginalName();
                    // $image->move('/uploads/video/thumbnail', $imageNameVer);
                    if (config('app.env') === 'production') {
                        $image->move('uploads/video/thumbnail', $imageNameVer);
                    } else {
                        $image->move(public_path('/uploads/video/thumbnail'), $imageNameVer);
                    }
                }
                // end:: vertical image upload

                // start:: video upload
                if (!empty($request->file('video'))) {
                    $video     = $request->file('video');
                    $videoName = time() . '.' . $video->getClientOriginalName();
                    // $video->move('/uploads/video', $videoName);

                    if (config('app.env') === 'production') {
                        $video->move('uploads/video', $videoName);
                    } else {
                        $video->move(public_path('/uploads/video'), $videoName);
                    }
                }
                // end:: video upload

                //Start::TMDB Rating
                if (!empty($request->imdb_id)) {
                    $tmdbKey    = ImdbKey::first();
                    $tmdbRating = Http::get(
                        "https://api.themoviedb.org/3/" . $request->tmdb_type . "/" . $request->imdb_id . "?api_key=" . $tmdbKey->key
                    );
                    $tmdbRating = $tmdbRating->json();
                }
                // return response()->json($tmdbRating);

                //End::TMDB Rating
                $target                     = Video::where('id', $request->id)->first();
                $target->category_id        = $request->category_id ?? $target->category_id;
                $target->sub_category_id    = $request->sub_category_id ?? $target->sub_category_id;
                $target->title              = $request->title ?? $target->title;
                $target->year               = $request->year ?? $target->year;
                $target->duration_hour      = $request->duration_hour ?? $target->duration_hour;
                $target->duration           = $request->duration ?? $target->duration;
                $target->duration_sec       = $request->duration_sec ?? $target->duration_sec;
                $target->video_type         = $request->video_type ?? $target->video_type;
                $target->url                = $request->url ?? $target->url;
                $target->slug               = $request->slug ?? $target->slug;
                $target->type               = $request->type ?? $target->type;
                $target->trailer            = $request->trailer ?? $target->trailer;
                $target->video              = $videoName ?? $target->video;
                $target->thumbnail          = $imageName ?? $target->thumbnail;
                $target->thumbnail_vertical = $imageNameVer ?? $target->thumbnail_vertical;
                $target->video_on_off       = $request->video_on_off ?? 'off';
                $target->send_notification  = $request->send_notification ?? 'off';
                $target->comment_on_off     = $request->comment_on_off ?? 'off';
                $target->is_series          = $request->is_series ?? 'off';
                $target->is_trending        = $request->is_trending ?? 'off';
                $target->fake_view          = $request->fake_view;
                $target->is_parental        = $request->is_parental ?? 'off';
                $target->series_category_id = $request->series_category_id ?? $target->series_category_id;
                $target->series_id          = $request->series_id ?? $target->series_id;
                $target->season_id          = $request->season_id ?? $target->season_id;
                $target->episod_id          = $request->episod_id ?? $target->episod_id;
                $target->description        = $request->description ?? $target->description;
                $target->tmdb_type          = $request->tmdb_type ?? $target->tmdb_type;
                $target->imdb_id            = $request->imdb_id ?? $target->imdb_id;
                $target->show_tmdb          = $request->show_tmdb ?? $target->show_tmdb;
                $target->tmdb_rating        = !empty($tmdbRating['vote_average']) ? $tmdbRating['vote_average'] : '';
                $target->country_id         = json_encode($request->country_id);
                $target->celebrity_id       = json_encode($request->celebrity_id);
                $target->genre_id           = json_encode($request->genre_id);
                $target->director           = $request->director ?? $target->director;
                $target->writer             = $request->writer ?? $target->writer;
                $target->seo_title          = $request->seo_title ?? $target->seo_title;
                $target->meta_description   = $request->meta_description ?? $target->meta_description;
                $target->focus_keyword      = $request->focus_keyword ?? $target->focus_keyword;
                $target->seo_tag            = $request->seo_tag ?? $target->seo_tag;
                $target->status             = 'active';
                $target->updated_by         = auth()->id();
                $target->created_by         = auth()->id();
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
            $target = Video::find($request->id);

            if (empty($target)) {
                Session::flash('error', 'Invalid Data Id');
            }

            $fileName = 'uploads/video/thumbnail/' . $target->thumbnail;
            if (File::exists($fileName)) {
                File::delete($fileName);
            }

            $videoName = 'uploads/video/' . $target->video;
            if (File::exists($videoName)) {
                File::delete($videoName);
            }

            if ($target->delete()) {
                return Response::json(['success' => true], 200);
            } else {
                return Response::json(['success' => false], 404);
            }
        }
    }

    public function tmdbUpdate(Request $request)
    {
        if (auth()->user()->email === 'demoadmin@movieflix.com') {
            return Response::json(['success' => false], 401);
        } else {
            $target = Video::where('id', $request->id)->first();

            //Start::TMDB Rating
            if (!empty($target->imdb_id)) {
                $tmdbKey    = ImdbKey::first();
                $tmdbRating = Http::get(
                    "https://api.themoviedb.org/3/" . $target->tmdb_type . "/" . $target->imdb_id . "?api_key=" . $tmdbKey->key
                );
                $tmdbRating = $tmdbRating->json();
            }
            //End::TMDB Rating

            $target->tmdb_rating = !empty($tmdbRating['vote_average']) ? $tmdbRating['vote_average'] : '';

            if ($target->save()) {
                return Response::json(['success' => true], 200);
            }
        }
    }

    public function addFavorite(Request $request)
    {
        try {
            $prevData = FavoriteVideo::where('video_id', $request->video_id)->where('user_id', Auth()->id())->first();
            if (!empty($prevData)) {
                $prevData->delete();
            }

            if ($request->status == 'unchecked') {
                return Response::json(['success' => true, 'message' => 'Remove from favorite list'], 200);
            }

            $target           = new FavoriteVideo;
            $target->user_id  = Auth()->id();
            $target->video_id = $request->video_id;

            if ($target->save()) {
                return Response::json(['success' => true, 'message' => 'Add your favorite list'], 200);
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
        return Redirect::to('admin/video?' . $url);
    }

    public function requestMovie(Request $request)
    {
        $target = RequestMovie::orderBy('created_at', 'desc')->get();
        return view('video.requestMovie')->with(compact('target'));
    }

}