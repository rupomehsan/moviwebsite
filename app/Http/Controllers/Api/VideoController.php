<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Celebrity;
use App\Models\Comment;
use App\Models\Country;
use App\Models\FavoriteVideo;
use App\Models\Genre;
use App\Models\ImdbKey;
use App\Models\Season;
use App\Models\Video;
use App\Models\VideoView;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class VideoController extends Controller
{

    /**
     * @OA\Get(
     *      path="/video",
     *      operationId="index",
     *      tags={"Video"},
     *      summary="Get list of Video",
     *      description="Returns list of Video",
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
    public function index(Request $request)
    {
        try {

            // $videos = $videos->get();

            //Start::all videos
            $videos = Video::where('status', 'active')->with(['category'])->get();
            // dd($videos);
            //End::all videos

            return response([
                'status' => 'success',
                'data'   => $videos,
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
     *      path="/searched-video",
     *      operationId="searchedVideo",
     *      tags={"Video"},
     *      summary="Get searched list of Video",
     *      description="Returns list of searched Video",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={""},
     *               @OA\Property(property="search", type="text"),
     *            ),
     *        ),
     *    ),
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
    public function searchedVideo(Request $request)
    {
        try {
            $videos = Video::where('status', 'active')
                ->with(['category']);

            //Start::searched Videos
            $searchText = $request->search;
            if (!empty($searchText)) {
                $videos = $videos->where(function ($query) use ($searchText) {
                    $query->where('title', 'LIKE', '%' . $searchText . '%');
                });
            }
            //End::searched Videos

            $videos = $videos->get();

            return response([
                'status' => 'success',
                'data'   => $videos,
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
     *      path="/country-video",
     *      operationId="countryVideo",
     *      tags={"Video"},
     *      summary="Get country wise filter Videos",
     *      description="Returns list of country wise filtered Videos",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"country_id"},
     *               @OA\Property(property="country_id", type="text"),
     *            ),
     *        ),
     *    ),
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
    public function countryVideo(Request $request)
    {
        try {
            // dd($request->all());
            $videos = Video::where('status', 'active')
                ->with(['category']);

            //Start:: selected country Videos
            $videos = $videos->whereJsonContains('country_id', $request->country_id);

            //End:: selected country Videos

            $videos = $videos->get();

            return response([
                'status' => 'success',
                'data'   => $videos,
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
     *      path="/year-video",
     *      operationId="yearVideo",
     *      tags={"Video"},
     *      summary="Get year wise filter Videos",
     *      description="Returns list of year wise filtered Videos",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"year"},
     *               @OA\Property(property="year", type="text"),
     *            ),
     *        ),
     *    ),
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
    public function yearVideo(Request $request)
    {
        try {
            $videos = Video::where('status', 'active')
                ->with(['category']);

            //Start:: selected year Videos
            $videos = $videos->where('year', $request->year);
            //End:: selected year Videos

            $videos = $videos->get();

            return response([
                'status' => 'success',
                'data'   => $videos,
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
     *      path="/celebrity-video",
     *      operationId="celebrityVideo",
     *      tags={"Video"},
     *      summary="Get celebrity wise filter Videos",
     *      description="Returns list of celebrity wise filtered Videos",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"celebrity_id"},
     *               @OA\Property(property="celebrity_id", type="text"),
     *            ),
     *        ),
     *    ),
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
    public function celebrityVideo(Request $request)
    {
        try {
            $videos = Video::where('status', 'active')
                ->with(['category']);

            //Start:: selected celebrity Videos
            $videos = $videos->whereJsonContains('celebrity_id', $request->celebrity_id);
            //End:: selected celebrity Videos

            $videos = $videos->get();

            return response([
                'status' => 'success',
                'data'   => $videos,
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
     *      path="/genre-video",
     *      operationId="genreVideo",
     *      tags={"Video"},
     *      summary="Get genre wise filter Videos",
     *      description="Returns list of genre wise filtered Videos",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"genre_id"},
     *               @OA\Property(property="genre_id", type="text"),
     *            ),
     *        ),
     *    ),
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
    public function genreVideo(Request $request)
    {
        try {
            $videos = Video::where('status', 'active')
                ->with(['category']);

            //Start:: selected genre Videos
            $videos = $videos->whereJsonContains('genre_id', $request->genre_id);
            //End:: selected genre Videos

            $videos = $videos->get();

            return response([
                'status' => 'success',
                'data'   => $videos,
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
     *      path="/favorite-video",
     *      operationId="favoriteVideo",
     *      tags={"Video"},
     *      security={{"bearerAuth":{}}},
     *      summary="Get favorite list of Video",
     *      description="Returns list of favorite Video",
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
    public function favoriteVideo(Request $request)
    {
        try {
            //Start:: favorite video list
            $favoriteList = [];
            if (!empty(Auth()->id())) {
                $favoriteList = FavoriteVideo::where('user_id', Auth()->id())
                    ->pluck('video_id', 'video_id')->toArray();
            }
            //End:: favorite video list

            $videos = Video::where('status', 'active')
                ->with(['category'])
                ->whereIn('id', $favoriteList)
                ->get();

            return response([
                'status' => 'success',
                'data'   => $videos,
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function clearFavoriteVideo(Request $request)
    {
        try {
            //Start:: favorite video list
            $favoriteList = FavoriteVideo::where('user_id', Auth()->id())->get();
            //End:: favorite video list
            // dd($favoriteList);
            if (!empty($favoriteList)) {
                $favoriteList = FavoriteVideo::where('user_id', Auth()->id())->delete();
            }
            return response([
                'status'  => 'success',
                'message' => 'Favorite List Clear Successfully',
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function singleClearFavoriteVideo(Request $request, $id)
    {
        try {
            //Start:: favorite video list
            $favoriteList = FavoriteVideo::where('user_id', Auth()->id())->where('video_id', $id)->get();
            //End:: favorite video list
            if (!empty($favoriteList)) {
                $favoriteList = FavoriteVideo::where('user_id', Auth()->id())->where('video_id', $id)->delete();
            }
            return response([
                'status'  => 'success',
                'message' => 'Video Removed Successfully',
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
     ** path="/add-favorite-video",
     *   operationId="addFavoriteVideo",
     *   tags={"Video"},
     *   security={{"bearerAuth":{}}},
     *   summary="Set your favorite video",
     *
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"video_id", "comment"},
     *               @OA\Property(property="video_id", type="int"),
     *               @OA\Property(property="status", type="status"),
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
    public function addFavoriteVideo(Request $request)
    {
        try {

            // dd($request->all());
            $validate = Validator::make(request()->all(), [
                'video_id' => 'required',
                'status'   => 'required|in:checked,unchecked',
            ]);

            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }

            $prevData = FavoriteVideo::where('video_id', $request->video_id)->where('user_id', Auth()->id())->first();
            if (!empty($prevData)) {
                $prevData->delete();
            }

            if ($request->status == 'unchecked') {
                return response([
                    'status'  => 'success',
                    'message' => 'Remove from favorite list',
                ], 200);
            }

            $target           = new FavoriteVideo;
            $target->user_id  = Auth()->id();
            $target->video_id = $request->video_id;
            if ($target->save()) {
                return response([
                    'status'  => 'success',
                    'message' => 'Add your favorite list',
                ], 200);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    /**
     * @OA\Get(
     *      path="/history-video",
     *      operationId="historyVideo",
     *      tags={"Video"},
     *      security={{"bearerAuth":{}}},
     *      summary="Get history list of Video",
     *      description="Returns list of history Video",
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
    public function historyVideo(Request $request)
    {
        try {

            //Start:: history video list
            $historyList = [];
            if (!empty(Auth()->id())) {
                $historyList = VideoView::where('user_id', Auth()->id())->pluck('video_id', 'video_id')->toArray();
            }
            //End:: history video list

            $videos = Video::where('status', 'active')
                ->with(['category'])
                ->whereIn('id', $historyList)
                ->get();

            return response([
                'status' => 'success',
                'data'   => $videos,
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function clearHistoryVideo(Request $request)
    {
        try {
            //Start:: history video list
            $historyList = VideoView::where('user_id', Auth()->id())->get();
            //End:: history video list
            if (!empty($historyList)) {
                $historyList = VideoView::where('user_id', Auth()->id())->delete();
            }
            return response([
                'status'  => 'success',
                'message' => 'History List Clear Successfully',
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function singleClearHistoryVideo(Request $request, $id)
    {
        try {
            //Start:: history video list
            $historyList = VideoView::where('user_id', Auth()->id())->where('video_id', $id)->get();
            //End:: history video list
            if (!empty($historyList)) {
                $historyList = VideoView::where('user_id', Auth()->id())->where('video_id', $id)->delete();
            }
            return response([
                'status'  => 'success',
                'message' => 'Video Removed Successfully',
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
     *      path="/years",
     *      operationId="years",
     *      tags={"Video"},
     *      summary="Get list of Video years",
     *      description="Returns list of Video years",
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
    public function years(Request $request)
    {
        try {

            $years = Video::where('status', 'active')
                ->select('year', DB::raw('count(*) as total'))
                ->groupBy('year')
                ->get();

            return response([
                'status' => 'success',
                'data'   => $years,
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
     ** path="/season-wise-episode",
     *   operationId="seasonWiseEpisode",
     *   tags={"Video"},
     *   summary="season wise episode",
     *
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"season_id"},
     *               @OA\Property(property="season_id", type="int"),
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

    public function seasonWiseEpisode(Request $request)
    {
        try {

            $validate = Validator::make(request()->all(), [
                'season_id' => 'required',
            ]);

            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }

            $episodeInfo = Video::where('season_id', $request->season_id)->get();

            return response([
                'status' => 'success',
                'episod' => $episodeInfo,
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
     *      path="/video/{id}/show",
     *      operationId="show",
     *      tags={"Video"},
     *      summary="Show video",
     *  @OA\Parameter(
     *          name="id",
     *          description="Video Id",
     *          required=true,
     *          in="path"
     *      ),
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

    public function show(Request $request, $id)
    {
        try {
            $target          = Video::where('id', $id)->with(['category', 'series', 'season', 'episod'])->first();
            $videoViewsCount = 0;
            if (!empty($target->fake_view)) {
                $videoViewsCount = $target->fake_view;
            } else {
                $videoViewsCount = VideoView::where('videos_id', $id)->count();
            }
            $videoViewsCount = $this->numberConvert($videoViewsCount);

            //Start::TMDB Rating
            $tmdbRating = null;
            $tmdbKey    = ImdbKey::first();
            if (!empty($tmdbKey)) {
                if (!empty($target->imdb_id)) {
                    $tmdbRating = Http::get(
                        "https://api.themoviedb.org/3/movie/" . $target->imdb_id . "?api_key=" . $tmdbKey->key
                    );
                    $tmdbRating = $tmdbRating->json();
                }
            }
            // dd($tmdbRating['vote_average']);
            //End::TMDB Rating

            //Start:: Selected video Comment
            $commentInfo = Comment::leftJoin('users', 'users.id', 'comments.created_by')
                ->where('comments.video_id', $id)
                ->where('comments.status', 'active')
                ->select('comments.*', 'users.id as user_id', 'users.name as user_name', 'users.image as user_image')
                ->get();
            //End:: Selected video Comment

            // start::series data
            $episodeInfo = [];
            $seasonList  = [];
            if ($target->is_series === 'on') {
                $seasonList = Season::where('series_id', $target->series_id)
                    ->get();

                $episodeInfo = Video::where('season_id', $target->season_id)->get();

            }
            // end::series data

            //get country data
            $countryId    = $countryArr    = [];
            $countryNames = '';
            if (!empty($target->country_id)) {
                $countryId = json_decode($target->country_id);
            }

            if (!empty($countryId)) {
                $countryArr = Country::whereIn('id', $countryId)->pluck('name', 'id')->toArray();
            }
            if (!empty($countryArr)) {
                foreach ($countryArr as $id => $name) {
                    $countryNames = $countryNames . (!empty($countryNames) ? ', ' : '') . $name;
                }
            }
            // dd($countryNames);

            //get genre data
            $genreId    = $genreArr    = [];
            $genreNames = '';
            if (!empty($target->genre_id)) {
                $genreId = json_decode($target->genre_id);
            }

            if (!empty($genreId)) {
                $genreArr = Genre::whereIn('id', $genreId)->pluck('name', 'id')->toArray();
            }
            if (!empty($genreArr)) {
                foreach ($genreArr as $id => $name) {
                    $genreNames = $genreNames . (!empty($genreNames) ? ', ' : '') . $name;
                }
            }
            // dd($genreNames);

            //get celibrity data
            $celibrityId    = $celibritiesArr    = [];
            $celibrityNames = [];
            $i              = 0;
            if (!empty($target->celebrity_id)) {
                $celibrityId = json_decode($target->celebrity_id);
            }
            if (!empty($celibrityId)) {
                // $celibritiesArr = Celebrity::whereIn('id', $celibrityId)->pluck('name', 'id')->toArray();
                $celibritiesArr = Celebrity::whereIn('id', $celibrityId)->get();
            }
            if (!empty($celibritiesArr)) {
                foreach ($celibritiesArr as $data) {
                    $celibrityNames[$i++] = $data;
                }
            }
            //get celibrity data end

            //start:: store video views history
            $viewUser = null;
            $ip       = $request->ip();
            if (!empty($request->user_id)) {
                $viewUser = $request->user_id;
            }
            $prevViewUser = VideoView::where('video_id', $target->id)
                ->where('user_id', $viewUser)
                ->where('ip_address', $ip)
                ->first();
            if (!empty($prevViewUser)) {
                $prevViewUser = $prevViewUser->delete();
            }
            $videoViews             = new VideoView;
            $videoViews->video_id   = $target->id;
            $videoViews->user_id    = $viewUser;
            $videoViews->ip_address = $ip;
            $videoViews->save();
            //End:: store video views history
            //Start:: Don't Miss
            $dontMissVideoInfo = Video::inRandomOrder()->take(12)->get();
            //End:: Don't Miss

            return response([
                'status'          => 'success',
                'video'           => $target,
                'videoViewsCount' => $videoViewsCount,
                'tmdb'            => $tmdbRating,
                'countrys'        => $countryNames,
                'genres'          => $genreNames,
                'season'          => $seasonList,
                'episod'          => $episodeInfo,
                'comments'        => $commentInfo,
                'celebrity'       => $celibrityNames,
                'you_may'         => $dontMissVideoInfo,
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function numberConvert($number)
    {
        $abbrevs = array(12 => "T", 9 => "B", 6 => "M", 3 => "K", 0 => "");
        foreach ($abbrevs as $exponent => $abbrev) {
            if ($number >= pow(10, $exponent)) {
                $display_num = $number / pow(10, $exponent);
                $decimals    = ($exponent >= 3 && round($display_num) < 100) ? 1 : 0;
                return number_format($display_num, $decimals) . $abbrev;
            }
        }
        return number_format(is_numeric($display_num) ? $display_num : 0, 0); //Not returned yet? Fall back to this.
    }

}