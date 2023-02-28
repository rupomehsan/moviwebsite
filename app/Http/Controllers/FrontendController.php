<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Celebrity;
use App\Models\Comment;
use App\Models\Country;
use App\Models\FavoriteVideo;
use App\Models\Genre;
use App\Models\ImdbKey;
use App\Models\Package;
use App\Models\PackageSubscriber;
use App\Models\PaymentGatway;
use App\Models\RequestMovie;
use App\Models\Season;
use App\Models\Setting;
use App\Models\SubCategory;
use App\Models\TvChannel;
use App\Models\TvChannelCategory;
use App\Models\Video;
use App\Models\VideoSetting;
use App\Models\VideoView;
use App\Models\WebAd;
use Carbon\Carbon;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Response;
use Validator;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        try {
            $embededCode = [];
            // Start:: Ads
            $adsInfo = WebAd::get();
            // End:: Ads

            $videoSettingsinfo = VideoSetting::where('show_page', 'home')->get();
            $settingsData      = [];
            if (!$videoSettingsinfo->isEmpty()) {
                foreach ($videoSettingsinfo as $key => $settings) {
                    $settingsData[$settings->name]['video_number']     = $settings->video_number;
                    $settingsData[$settings->name]['vertical_image']   = $settings->vertical_image;
                    $settingsData[$settings->name]['horizontal_image'] = $settings->horizontal_image;
                }
            }

            //Start:: favorite video list
            $favoriteList = [];

            if (!empty(Auth()->id())) {
                $favoriteList = FavoriteVideo::where('user_id', Auth()->id())->pluck('video_id', 'video_id')->toArray();
            }
            //End:: favorite video list

            //Start:: just added video
            $justAdded = Video::where('status', 'active')
                ->where('created_at', '>', now()->subDays(7))
                ->orderBy('created_at', 'DESC')
                ->take(8)
                ->get();
            //End:: just added video

            //Start:: populer video
            $populerVideoList = VideoView::where('created_at', '>', now()->subDays(30))
                ->get();
            $populerVideoCount = $poulerListArr = [];
            if (!$populerVideoList->isEmpty()) {
                foreach ($populerVideoList as $populer) {
                    $populerVideoCount[$populer->video_id] = !empty($populerVideoCount[$populer->video_id]) ? $populerVideoCount[$populer->video_id] : 0;
                    $populerVideoCount[$populer->video_id] += 1;
                }
            }
            if (!empty($populerVideoCount)) {
                $i = 1;
                arsort($populerVideoCount);
                foreach ($populerVideoCount as $videoId => $total) {
                    $poulerListArr[$i++] = $videoId;
                }

            }

            $populerVideoInfo = Video::where('status', 'active')->where('type', '!=', 'premium')
                ->whereIn('id', $poulerListArr)
                ->take(10)
                ->get();

            $popularCelibrityId = $popularCelibritiesArr = [];
            if (!$populerVideoInfo->isEmpty()) {
                foreach ($populerVideoInfo as $data) {
                    //Celebrity
                    if (!empty($data->celebrity_id)) {
                        $popularCelibrityId[$data->id] = json_decode($data->celebrity_id);
                    }
                    if (!empty($popularCelibrityId[$data->id])) {
                        $popularCelibritiesArr[$data->id] = Celebrity::whereIn('id', $popularCelibrityId[$data->id])
                            ->select('name', 'id', 'image', 'file_type', 'file_link')->get();
                    }
                }
            }
            // dd($populerVideoInfo);
            //End:: populer video

            //Start:: trending video
            $trendingVideoList = VideoView::where('created_at', '>', now()->subDays(7))
                ->get();
            $trendingVideoCount = $poulerListArr = [];
            if (!$trendingVideoList->isEmpty()) {
                foreach ($trendingVideoList as $trending) {
                    $trendingVideoCount[$trending->video_id] = !empty($trendingVideoCount[$trending->video_id]) ? $trendingVideoCount[$trending->video_id] : 0;
                    $trendingVideoCount[$trending->video_id] += 1;
                }
            }
            if (!empty($trendingVideoCount)) {
                $i = 1;
                arsort($trendingVideoCount);
                foreach ($trendingVideoCount as $videoId => $total) {
                    $poulerListArr[$i++] = $videoId;
                }

            }

            $trendingVideoInfo = Video::where('status', 'active')
                ->whereIn('id', $poulerListArr)
                ->take(10)
                ->get();

            // dd($trendingVideoInfo);

            $genreId = $genreArr = $celibrityId = $celibritiesArr = $tmdbRatingArr = [];
            if (!$trendingVideoInfo->isEmpty()) {
                foreach ($trendingVideoInfo as $data) {
                    //genre data
                    if (!empty($data->genre_id)) {
                        $genreId[$data->id] = json_decode($data->genre_id);
                    }
                    if (!empty($genreId[$data->id])) {
                        $genreArr[$data->id] = Genre::whereIn('id', $genreId[$data->id])->pluck('name', 'id')->toArray();
                    }

                    //Celebrity
                    if (!empty($data->celebrity_id)) {
                        $celibrityId[$data->id] = json_decode($data->celebrity_id);
                    }
                    if (!empty($celibrityId[$data->id])) {
                        $celibritiesArr[$data->id] = Celebrity::whereIn('id', $celibrityId[$data->id])
                            ->select('name', 'id', 'image', 'file_type', 'file_link')->get();
                    }

                    //Start::TMDB Rating
                    $tmdbKey = ImdbKey::first();
                    if (!empty($tmdbKey)) {
                        $tmdbRating = Http::get(
                            "https://api.themoviedb.org/3/movie/" . $data->imdb_id . "?api_key=" . ($tmdbKey->key ?? '')
                        );
                        $tmdbRatingArr[$data->id] = $tmdbRating->json();
                        //End::TMDB Rating
                    }
                }
            }

            // dd($celibritiesArr);
            //End:: trending video

            //Start:: category Video
            $categoryShow = Category::join('videos', 'videos.category_id', 'categories.id')
                ->where('categories.status', 'active')->pluck('categories.name', 'categories.id')->toArray();
            $categoryIdArr = [];
            $i             = 0;
            if (!empty($categoryShow)) {
                foreach ($categoryShow as $id => $name) {
                    $categoryIdArr[$i++] = $id;
                }
            }
            $categoryVideoInfo = Video::whereIn('category_id', $categoryIdArr)->get();
            //End:: category Video

            return view('frontend.client.index')->with(compact('embededCode', 'adsInfo', 'genreArr', 'celibritiesArr', 'tmdbRatingArr', 'videoSettingsinfo'
                , 'settingsData', 'favoriteList', 'justAdded', 'popularCelibrityId', 'popularCelibritiesArr'
                , 'categoryShow', 'populerVideoInfo', 'trendingVideoInfo', 'categoryVideoInfo'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function categoryIndex(Request $request)
    {
        try {
            // dd($request->all());
            $embededCode = [];
            // Start:: Ads
            $adsInfo = WebAd::get();
            // End:: Ads

            // Start:: Banner
            $bannarInfo = Banner::leftJoin('videos', 'videos.id', 'banners.video_id')
                ->where('banners.category_id', $request->category_id)
                ->whereIn('banners.banner_type', ['categoryImage', 'categoryVideo'])
                ->select('banners.title as banner_title', 'banners.url as banner_url', 'banners.image as banner_image'
                    , 'banners.banner_type', 'videos.title as video_title', 'videos.description as video_description'
                    , 'videos.thumbnail', 'videos.genre_id', 'videos.celebrity_id', 'videos.id as video_id')
                ->get();
            // dd($bannarInfo);
            //banner video data
            $genreId = $genreArr = $celibrityId = $celibritiesArr = [];
            if (!$bannarInfo->isEmpty()) {
                foreach ($bannarInfo as $banner) {

                    if ($banner->banner_type === 'video') {
                        //genre data
                        if (!empty($banner->genre_id)) {
                            $genreId[$banner->video_id] = json_decode($banner->genre_id);
                        }
                        if (!empty($genreId[$banner->video_id])) {
                            $genreArr[$banner->video_id] = Genre::whereIn('id', $genreId[$banner->video_id])->pluck('name', 'id')->toArray();
                        }

                        //Celebrity
                        if (!empty($banner->celebrity_id)) {
                            $celibrityId[$banner->video_id] = json_decode($banner->celebrity_id);
                        }
                        if (!empty($celibrityId[$banner->video_id])) {
                            $celibritiesArr[$banner->video_id] = Celebrity::whereIn('id', $celibrityId[$banner->video_id])
                                ->select('name', 'id', 'image', 'file_type', 'file_link')->get();
                        }
                    }

                }
            }
            // dd($celibritiesArr);
            // End:: Banner

            $videoSettingsinfo = VideoSetting::where('show_page', '!=', 'home')
                ->where('category_id', $request->category_id)->get();
            $settingsData = [];
            if (!$videoSettingsinfo->isEmpty()) {
                foreach ($videoSettingsinfo as $key => $settings) {
                    $settingsData[$settings->name]['video_number']     = $settings->video_number;
                    $settingsData[$settings->name]['vertical_image']   = $settings->vertical_image;
                    $settingsData[$settings->name]['horizontal_image'] = $settings->horizontal_image;
                }
            }

            //Start:: favorite video list
            $favoriteList = [];
            if (!empty(Auth()->id())) {
                $favoriteList = FavoriteVideo::where('user_id', Auth()->id())->pluck('video_id', 'video_id')->toArray();
            }
            //End:: favorite video list

            //Start:: just added video
            $justAdded = Video::where('status', 'active')
                ->where('category_id', $request->category_id)
                ->where('created_at', '>', now()->subDays(7))
                ->orderBy('created_at', 'DESC')
                ->take(8)
                ->get();
            //End:: just added video

            //Start:: populer video
            $populerVideoList = VideoView::where('created_at', '>', now()->subDays(30))
                ->get();
            $populerVideoCount = $poulerListArr = [];
            if (!$populerVideoList->isEmpty()) {
                foreach ($populerVideoList as $populer) {
                    $populerVideoCount[$populer->video_id] = !empty($populerVideoCount[$populer->video_id]) ? $populerVideoCount[$populer->video_id] : 0;
                    $populerVideoCount[$populer->video_id] += 1;
                }
            }
            if (!empty($populerVideoCount)) {
                $i = 1;
                arsort($populerVideoCount);
                foreach ($populerVideoCount as $videoId => $total) {
                    $poulerListArr[$i++] = $videoId;
                }

            }

            $populerVideoInfo = Video::where('status', 'active')
                ->where('category_id', $request->category_id)->where('type', '!=', 'premium')
                ->whereIn('id', $poulerListArr)
                ->take(10)
                ->get();
            // dd($populerVideoInfo);
            //End:: populer video

            //Start:: trending video
            $trendingVideoList = VideoView::where('created_at', '>', now()->subDays(7))
                ->get();
            $trendingVideoCount = $poulerListArr = [];
            if (!$trendingVideoList->isEmpty()) {
                foreach ($trendingVideoList as $trending) {
                    $trendingVideoCount[$trending->video_id] = !empty($trendingVideoCount[$trending->video_id]) ? $trendingVideoCount[$trending->video_id] : 0;
                    $trendingVideoCount[$trending->video_id] += 1;
                }
            }
            if (!empty($trendingVideoCount)) {
                $i = 1;
                arsort($trendingVideoCount);
                foreach ($trendingVideoCount as $videoId => $total) {
                    $poulerListArr[$i++] = $videoId;
                }

            }

            $trendingVideoInfo = Video::where('status', 'active')
                ->where('category_id', $request->category_id)
                ->whereIn('id', $poulerListArr)
                ->take(10)
                ->get();
            $genreId = $genreArr = $celibrityId = $celibritiesArr = $tmdbRatingArr = [];
            if (!$trendingVideoInfo->isEmpty()) {
                foreach ($trendingVideoInfo as $data) {
                    //genre data
                    if (!empty($data->genre_id)) {
                        $genreId[$data->id] = json_decode($data->genre_id);
                    }
                    if (!empty($genreId[$data->id])) {
                        $genreArr[$data->id] = Genre::whereIn('id', $genreId[$data->id])->pluck('name', 'id')->toArray();
                    }

                    //Celebrity
                    if (!empty($data->celebrity_id)) {
                        $celibrityId[$data->id] = json_decode($data->celebrity_id);
                    }
                    if (!empty($celibrityId[$data->id])) {
                        $celibritiesArr[$data->id] = Celebrity::whereIn('id', $celibrityId[$data->id])
                            ->select('name', 'id', 'image', 'file_type', 'file_link')->get();
                    }

                    //Start::TMDB Rating
                    $tmdbKey = ImdbKey::first();
                    if (!empty($tmdbKey)) {
                        $tmdbRating = Http::get(
                            "https://api.themoviedb.org/3/movie/" . $data->imdb_id . "?api_key=" . ($tmdbKey->key ?? '')
                        );
                        $tmdbRatingArr[$data->id] = $tmdbRating->json();
                        //End::TMDB Rating
                    }
                }
            }

            // dd($genreArr);
            //End:: trending video

            //Start:: sub category Video
            $subCategoryShow = SubCategory::join('videos', 'videos.sub_category_id', 'sub_categories.id')
                ->where('sub_categories.status', 'active')
                ->where('sub_categories.category_id', $request->category_id)
                ->pluck('sub_categories.name', 'sub_categories.id')->toArray();

            $subCategoryIdArr = [];
            $i                = 0;
            if (!empty($subCategoryShow)) {
                foreach ($subCategoryShow as $id => $name) {
                    $subCategoryIdArr[$i++] = $id;
                }
            }
            $subCategoryVideoInfo = Video::whereIn('category_id', $subCategoryIdArr)->get();
            //End:: category Video

            return view('frontend.client.categoryIndex')->with(compact('embededCode', 'adsInfo', 'bannarInfo', 'genreArr', 'celibritiesArr', 'videoSettingsinfo'
                , 'settingsData', 'favoriteList', 'justAdded'
                , 'subCategoryShow', 'populerVideoInfo', 'trendingVideoInfo', 'subCategoryVideoInfo'));
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

    public function videoshow(Request $request, $id)
    {
        try {
            // Start:: Ads
            $adsInfo = WebAd::get();
            // End:: Ads

            //Start:: favorite video list
            $favoriteList = [];
            if (!empty(Auth()->id())) {
                $favoriteList = FavoriteVideo::where('user_id', Auth()->id())->pluck('video_id', 'video_id')->toArray();
            }
            //End:: favorite video list

            //Start:: Selected video Data
            $selectedVideoInfo = Video::leftJoin('categories', 'categories.id', 'videos.category_id')
                ->leftJoin('sub_categories', 'sub_categories.id', 'videos.sub_category_id')
                ->where('videos.id', $id)->select('videos.*', 'categories.name as category_name', 'sub_categories.name as sub_category_name')->first();

            $videoViewsCount = 0;
            if (!empty($selectedVideoInfo->fake_view)) {
                $videoViewsCount = $selectedVideoInfo->fake_view;
            } else {
                $videoViewsCount = VideoView::where('videos_id', $id)->count();
            }
            $videoViewsCount = $this->numberConvert($videoViewsCount);

            if ($selectedVideoInfo->video_type == '1') {
                $videoCode = substr($selectedVideoInfo->url, -11, 11);
                $embeded   = <<<TEXT
                <iframe width="100%" height="100%" src="//www.youtube.com/embed/$videoCode" frameborder="0" allowfullscreen></iframe>
TEXT;
            } elseif ($selectedVideoInfo->video_type == '2') {
                $videoCode = substr($selectedVideoInfo->url, -9, 9);
                $embeded   = <<<TEXT
                <iframe width="100%" height="100%" src="https://player.vimeo.com/video/$videoCode" frameborder="0" allowfullscreen></iframe>
TEXT;
            } elseif ($selectedVideoInfo->video_type == '3') {
                $videoCode = substr($selectedVideoInfo->url, -7, 7);
                $embeded   = <<<TEXT
                <iframe width="100%" height="100%" src="https://www.dailymotion.com/embed/video/$videoCode" frameborder="0" allowfullscreen></iframe>
TEXT;
            }

            // dd($embeded);

            $trailerCode = substr($selectedVideoInfo->trailer, -11, 11);
            $trailer     = <<<TEXT
                <iframe width="100%" src="//www.youtube.com/embed/$trailerCode" frameborder="0" allowfullscreen></iframe>
TEXT;
            //End:: Selected video Data

            //Start::TMDB Rating
            $tmdbKey    = ImdbKey::first();
            $tmdbRating = Http::get(
                "https://api.themoviedb.org/3/movie/" . $selectedVideoInfo->imdb_id . "?api_key=" . ($tmdbKey->key ?? '')
            );
            $tmdbRating = $tmdbRating->json();
            // return response()->json($tmdbRating);
            //End::TMDB Rating

            //Start:: Selected video Comment
            $commentInfo = Comment::leftJoin('users', 'users.id', 'comments.created_by')
                ->where('comments.video_id', $id)
                ->where('comments.status', 'active')
                ->select('comments.*', 'users.id as user_id', 'users.name as user_name', 'users.image as user_image')
                ->get();
            // dd($commentInfo);
            //End:: Selected video Comment

            // start::series data
            $episodeInfo = '';
            $seasonList  = [];
            if ($selectedVideoInfo->is_series === 'on') {
                $seasonList = Season::where('series_id', $selectedVideoInfo->series_id)
                    ->pluck('name', 'id')->toArray();

                $episodeInfo = Video::where('season_id', $selectedVideoInfo->season_id)->get();

            }
            // end::series data

            //get celibrity data
            $celibrityId    = $celibritiesArr    = [];
            $celibrityNames = '';
            if (!empty($selectedVideoInfo->celebrity_id)) {
                $celibrityId = json_decode($selectedVideoInfo->celebrity_id);
            }

            if (!empty($celibrityId)) {
                $celibritiesArr = Celebrity::whereIn('id', $celibrityId)->pluck('name', 'id')->toArray();
            }
            if (!empty($celibritiesArr)) {
                foreach ($celibritiesArr as $id => $name) {
                    $celibrityNames = $celibrityNames . (!empty($celibrityNames) ? ', ' : '') . $name;
                }
            }

            //get genre data
            $genreId    = $genreArr    = [];
            $genreNames = '';
            if (!empty($selectedVideoInfo->genre_id)) {
                $genreId = json_decode($selectedVideoInfo->genre_id);
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

            //get country data
            $countryId    = $countryArr    = [];
            $countryNames = '';
            if (!empty($selectedVideoInfo->country_id)) {
                $countryId = json_decode($selectedVideoInfo->country_id);
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

            //start:: store video views history
            $viewUser = null;
            $ip       = $request->ip();
            if (!empty(Auth()->id())) {
                $viewUser = Auth()->id();
            }
            $prevViewUser = VideoView::where('video_id', $selectedVideoInfo->id)
                ->where('user_id', $viewUser)
                ->where('ip_address', $ip)
                ->first();
            if (!empty($prevViewUser)) {
                $prevViewUser = $prevViewUser->delete();
            }
            $videoViews             = new VideoView;
            $videoViews->video_id   = $selectedVideoInfo->id;
            $videoViews->user_id    = $viewUser;
            $videoViews->ip_address = $ip;
            $videoViews->save();
            //End:: store video views history

            //Start::You May Also Like video
            $youLikeVideo = Video::inRandomOrder()->take(12)->get();
            //End::You May Also Like video

            // Start:: Premium video info
            $subscriber = '';
            if ($selectedVideoInfo->type == 'premium') {
                $subscriber = PackageSubscriber::where('user_id', auth()->id())
                    ->where('end_date', '>=', Carbon::now())->get();
                // dd($subscriber);
            }
            // End:: Premium video info

            return view('frontend.client.videoshow')->with(compact('adsInfo', 'youLikeVideo', 'selectedVideoInfo', 'trailer', 'tmdbRating', 'embeded', 'commentInfo', 'episodeInfo'
                , 'seasonList', 'celibrityNames', 'genreNames', 'countryNames', 'favoriteList', 'subscriber', 'videoViewsCount'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function watchTrailer(Request $request)
    {
        // dd($request->trailer);
        //Start:: favorite video list

        $trailerCode = substr($request->trailer, -11, 11);
        $trailer     = <<<TEXT
            <iframe width="100%" src="//www.youtube.com/embed/$trailerCode" frameborder="0" allowfullscreen></iframe>
TEXT;

        // dd($episodeInfo);
        $view = view('frontend.client.getTrailer', compact('trailer'))->render();
        return response()->json(['html' => $view]);
    }

    public function allVideo(Request $request)
    {
        try {
            $type = $request->type;
            // dd($type);

            //Start:: favorite video list
            $favoriteList = [];
            if (!empty(Auth()->id())) {
                $favoriteList = FavoriteVideo::where('user_id', Auth()->id())->pluck('video_id', 'video_id')->toArray();
            }
            //End:: favorite video list

            //Start:: history video list
            $historyList = [];
            if (!empty(Auth()->id())) {
                $historyList = VideoView::where('user_id', Auth()->id())->pluck('video_id', 'video_id')->toArray();
            }
            //End:: history video list

            //Start::all videos
            $videos = Video::where('status', 'active');
            //End::all videos

            //Start::favourite Videos
            if ((!empty($request->type)) && ($request->type == 'favourite')) {
                $videos = $videos->whereIn('id', $favoriteList);
            }
            //End::favourite Videos

            //Start::history Videos
            if ((!empty($request->type)) && ($request->type == 'history')) {
                $videos = $videos->whereIn('id', $historyList);
            }
            //End::history Videos

            //Start::favourite Videos
            $searchText = $request->search;
            if (!empty($searchText)) {
                $videos = $videos->where(function ($query) use ($searchText) {
                    $query->where('title', 'LIKE', '%' . $searchText . '%');
                });
            }
            //End::favourite Videos

            //Start:: selected country Videos
            if ((!empty($request->type)) && ($request->type == 'country')) {
                $videos = $videos->whereJsonContains('country_id', $request->country_id);
            }
            //End:: selected country Videos

            //Start:: selected year Videos
            if ((!empty($request->type)) && ($request->type == 'year')) {
                $videos = $videos->where('year', $request->year);
            }
            //End:: selected year Videos

            //Start:: selected celebrity Videos
            if ((!empty($request->type)) && ($request->type == 'celebrity')) {
                $videos = $videos->whereJsonContains('celebrity_id', $request->celebrity_id);
            }
            //End:: selected celebrity Videos

            //Start:: selected genre Videos
            if ((!empty($request->type)) && ($request->type == 'genre')) {
                $videos = $videos->whereJsonContains('genre_id', $request->genre_id);
            }
            //End:: selected genre Videos

            $videos = $videos->get();

            return view('frontend.client.allVideo')->with(compact('favoriteList', 'videos', 'request'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function filter(Request $request)
    {
        $url = 'search=' . $request->search;
        // dd($url);
        return Redirect::to('video?' . $url);
    }

    public function category(Request $request)
    {
        try {
            // Start:: Ads
            $adsInfo = WebAd::get();
            // End:: Ads

            //Start:: category
            $categoryInfo = Category::where('status', 'active')->get();
            //End:: category

            //country
            $countryInfo = Country::where('status', 'active')->get();

            //celebrities
            $celebrityInfo = Celebrity::where('status', 'active')->get();
            // dd($celebrityInfo);

            //genre
            $genreInfo = Genre::where('status', 'active')->get();

            // year
            $years = Video::where('status', 'active')
                ->select('year', DB::raw('count(*) as total'))
                ->groupBy('year')
                ->get();
            // dd($years);

            // live Tv
            $tvInfo = TvChannel::where('status', 'active')->get();
            // dd($tvInfo);
            // live Tv

            return view('frontend.client.category')->with(compact('adsInfo', 'categoryInfo', 'countryInfo', 'celebrityInfo', 'genreInfo', 'years', 'tvInfo'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getEpisod(Request $request)
    {
        //Start:: favorite video list
        $favoriteList = [];
        if (!empty(Auth()->id())) {
            $favoriteList = FavoriteVideo::where('user_id', Auth()->id())->pluck('video_id', 'video_id')->toArray();
        }
        //End:: favorite video list
        $episodeInfo = Video::where('season_id', $request->season_id)->where('is_series', 'on')->get();
        // dd($episodeInfo);
        $view = view('frontend.client.getEpisod', compact('episodeInfo', 'favoriteList'))->render();
        return response()->json(['html' => $view]);
    }

    public function liveTv(Request $request, $id)
    {
        try {
            // Start:: Ads
            $adsInfo = WebAd::get();
            // End:: Ads

            //Start:: Selected video Data
            $tvInfo = TvChannel::where('id', $id)->first();

            if ($tvInfo->stream_type == 'youtube') {
                $videoCode = substr($tvInfo->url, -11, 11);
                $embeded   = <<<TEXT
                <iframe width="100%" height="100%" src="//www.youtube.com/embed/$videoCode" frameborder="0" allowfullscreen></iframe>
TEXT;
            } else {
                $embeded = $tvInfo->url;
            }

            //Start::You May Also Like video
            $remainingTvInfo = TvChannel::where('id', '!=', $id)->get();
            // dd($id);
            //End::You May Also Like video

            return view('frontend.client.livetv')->with(compact('adsInfo', 'tvInfo', 'embeded', 'remainingTvInfo'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function tvChannelRender(Request $request)
    {

        try {
            //Start:: Selected video Data
            $tvInfo = TvChannel::where('id', $request->id)->first();

            if ($tvInfo->stream_type == 'youtube') {
                $videoCode = substr($tvInfo->url, -11, 11);
                $embeded   = <<<TEXT
                <iframe width="100%" height="100%" src="//www.youtube.com/embed/$videoCode" frameborder="0" allowfullscreen></iframe>
TEXT;
            } else {
                $embeded = $tvInfo->url;
            }



            $view = view('frontend.client.tvChannelRender', compact('tvInfo', 'embeded'))->render();
            return response()->json(['html' => $view]);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function tvChannelShow(Request $request)
    {
        try {
            // Start:: Ads
            $adsInfo = WebAd::get();
            // End:: Ads

            // Start:: Tv Channel Category
            $tvChannelCategory = TvChannelCategory::get();
            // dd($tvChannelCategory);
            // End::  Tv Channel Category

            //Start:: Selected video Data
            $tvInfo = TvChannel::join('tv_channel_categories', 'tv_channel_categories.id', 'tv_channels.tv_channel_category_id')
                ->orderBy('tv_channel_categories.id', 'asc')->select('tv_channels.*')->first();

            if ($tvInfo->stream_type == 'youtube') {
                $videoCode = substr($tvInfo->url, -11, 11);
                $embeded   = <<<TEXT
                <iframe width="100%" height="100%" src="//www.youtube.com/embed/$videoCode" frameborder="0" allowfullscreen></iframe>
TEXT;
            } else {
                $embeded = $tvInfo->url;
            }



            //Start::You May Also Like video
            $remainingTvInfo = TvChannel::join('tv_channel_categories', 'tv_channel_categories.id', 'tv_channels.tv_channel_category_id')
                ->orderBy('id', 'asc')->select('tv_channels.*')->get();
            // dd($remainingTvInfo);
            //End::You May Also Like video
            return view('frontend.client.tvChannelShow')->with(compact('adsInfo', 'tvInfo', 'embeded', 'remainingTvInfo', 'tvChannelCategory'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function tvChannelParentalAuthentication(Request $request)
    {
        try {

            $settings = Setting::select('parental_password')->first();
            if (!empty($settings) && ($settings->parental_password != $request->password)) {
                return response([
                    'status'  => 'error',
                    'message' => "Credentials doesn't matched...",
                ], 401);
            }

            //Start:: Selected video Data
            $tvInfo = TvChannel::where('id', $request->tv_channel_id)->first();

            if ($tvInfo->stream_type == 'youtube') {
                $videoCode = substr($tvInfo->url, -11, 11);
                $embeded   = <<<TEXT
                <iframe width="100%" height="100%" src="//www.youtube.com/embed/$videoCode" frameborder="0" allowfullscreen></iframe>
TEXT;
            } else {
                $embeded = $tvInfo->url;
            }
   
            $view = view('frontend.client.parentalTvChannelRender', compact('tvInfo', 'embeded'))->render();
            return response()->json(['html' => $view]);

        } catch (\Exception$e) {
            return response([
                'status'  => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function sendMovieRequest(Request $request)
    {
        try {
            $rules = [
                'name'       => 'required',
                'email'      => 'required',
                'movie_name' => 'required',
            ];
            $customMessages = [
                'name.required'       => 'Please enter your name.',
                'email.required'      => 'Please enter your email.',
                'movie_name.required' => 'Please enter your suggested movie name.',
            ];
            $validate = Validator::make(request()->all(), $rules, $customMessages);

            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
            }

            $target             = new RequestMovie();
            $target->name       = $request->name;
            $target->email      = $request->email;
            $target->movie_name = $request->movie_name;
            $target->message    = $request->message;
            if ($target->save()) {
                return Response::json(['success' => true], 200);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function clearHistory(Request $request)
    {
        $target = VideoView::where('video_id', $request->video_id)->where('user_id', Auth()->id())->first();
        // dd($target);

        if (empty($target)) {
            Session::flash('error', 'Invalid Data Id');
        }
        if ($target->delete()) {
            return Response::json(['success' => true, 'message' => 'Remove this video from your history'], 200);
        } else {
            return Response::json(['success' => false, 'message' => 'Somthing went wrong'], 404);
        }
    }

    public function getPackage(Request $request)
    {
        try {
            $package = Package::where('status', 'active')->get();
            return view('frontend.client.packages')->with(compact('package'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getSinglePackage(Request $request)
    {
        try {
            $package = Package::where('id', $request->id)->first();
            return Response::json(['success' => true, 'data' => $package], 200);

        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function selectPaymentMethod(Request $request)
    {
        try {
            $paymentSettings = PaymentGatway::first();
            $view            = view('frontend.client.getPaymentMethods', compact('request', 'paymentSettings'))->render();
            return response()->json(['html' => $view]);

        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function parentalAuthentication(Request $request)
    {
        try {
            $settings = Setting::select('parental_password')->first();

            if (!empty($settings) && ($settings->parental_password != $request->password)) {
                return response([
                    'status'  => 'error',
                    'message' => "Credentials doesn't matched...",
                ], 401);
            }

            //Start:: Selected video Data
            $selectedVideoInfo = Video::leftJoin('categories', 'categories.id', 'videos.category_id')
                ->leftJoin('sub_categories', 'sub_categories.id', 'videos.sub_category_id')
                ->where('videos.id', $request->video_id)->select('videos.*', 'categories.name as category_name', 'sub_categories.name as sub_category_name')->first();

            if ($selectedVideoInfo->video_type == '1') {
                $videoCode = substr($selectedVideoInfo->url, -11, 11);
                $embeded   = <<<TEXT
                <iframe width="100%" height="100%" src="//www.youtube.com/embed/$videoCode" frameborder="0" allowfullscreen></iframe>
TEXT;
            } elseif ($selectedVideoInfo->video_type == '2') {
                $videoCode = substr($selectedVideoInfo->url, -9, 9);
                $embeded   = <<<TEXT
                <iframe width="100%" height="100%" src="https://player.vimeo.com/video/$videoCode" frameborder="0" allowfullscreen></iframe>
TEXT;
            } elseif ($selectedVideoInfo->video_type == '3') {
                $videoCode = substr($selectedVideoInfo->url, -7, 7);
                $embeded   = <<<TEXT
                <iframe width="100%" height="100%" src="https://www.dailymotion.com/embed/video/$videoCode" frameborder="0" allowfullscreen></iframe>
TEXT;
            }

            // dd($embeded);

            $trailerCode = substr($selectedVideoInfo->trailer, -11, 11);
            $trailer     = <<<TEXT
                <iframe width="100%" src="//www.youtube.com/embed/$trailerCode" frameborder="0" allowfullscreen></iframe>
TEXT;
            //End:: Selected video Data

            //Start::TMDB Rating
            $tmdbKey    = ImdbKey::first();
            $tmdbRating = Http::get(
                "https://api.themoviedb.org/3/movie/" . $selectedVideoInfo->imdb_id . "?api_key=" . ($tmdbKey->key ?? '')
            );
            $tmdbRating = $tmdbRating->json();
            // return response()->json($tmdbRating);
            //End::TMDB Rating

            //Start:: Selected video Comment
            $commentInfo = Comment::leftJoin('users', 'users.id', 'comments.created_by')
                ->where('comments.video_id', $request->video_id)
                ->where('comments.status', 'active')
                ->select('comments.*', 'users.id as user_id', 'users.name as user_name', 'users.image as user_image')
                ->get();
            // dd($commentInfo);
            //End:: Selected video Comment

            // start::series data
            $episodeInfo = '';
            $seasonList  = [];
            if ($selectedVideoInfo->is_series === 'on') {
                $seasonList = Season::where('series_id', $selectedVideoInfo->series_id)
                    ->pluck('name', 'id')->toArray();

                $episodeInfo = Video::where('season_id', $selectedVideoInfo->season_id)->get();

            }
            // end::series data

            //get celibrity data
            $celibrityId    = $celibritiesArr    = [];
            $celibrityNames = '';
            if (!empty($selectedVideoInfo->celebrity_id)) {
                $celibrityId = json_decode($selectedVideoInfo->celebrity_id);
            }

            if (!empty($celibrityId)) {
                $celibritiesArr = Celebrity::whereIn('id', $celibrityId)->pluck('name', 'id')->toArray();
            }
            if (!empty($celibritiesArr)) {
                foreach ($celibritiesArr as $id => $name) {
                    $celibrityNames = $celibrityNames . (!empty($celibrityNames) ? ', ' : '') . $name;
                }
            }

            //get genre data
            $genreId    = $genreArr    = [];
            $genreNames = '';
            if (!empty($selectedVideoInfo->genre_id)) {
                $genreId = json_decode($selectedVideoInfo->genre_id);
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

            //get country data
            $countryId    = $countryArr    = [];
            $countryNames = '';
            if (!empty($selectedVideoInfo->country_id)) {
                $countryId = json_decode($selectedVideoInfo->country_id);
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

            //start:: store video views history
            $viewUser = null;
            $ip       = $request->ip();
            if (!empty(Auth()->id())) {
                $viewUser = Auth()->id();
            }
            $prevViewUser = VideoView::where('video_id', $selectedVideoInfo->id)
                ->where('user_id', $viewUser)
                ->where('ip_address', $ip)
                ->first();
            if (!empty($prevViewUser)) {
                $prevViewUser = $prevViewUser->delete();
            }
            $videoViews             = new VideoView;
            $videoViews->video_id   = $selectedVideoInfo->id;
            $videoViews->user_id    = $viewUser;
            $videoViews->ip_address = $ip;
            $videoViews->save();
            //End:: store video views history

            //Start:: favorite video list
            $favoriteList = [];
            if (!empty(Auth()->id())) {
                $favoriteList = FavoriteVideo::where('user_id', Auth()->id())->pluck('video_id', 'video_id')->toArray();
            }
            //End:: favorite video list

            $view = view('frontend.client.getParentalVideo', compact('selectedVideoInfo', 'trailer', 'tmdbRating', 'embeded'
                , 'commentInfo', 'episodeInfo', 'favoriteList'
                , 'seasonList', 'celibrityNames', 'genreNames', 'countryNames'))->render();
            return response()->json(['html' => $view]);

        } catch (\Exception$e) {
            return response([
                'status'  => 'serverError',
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
