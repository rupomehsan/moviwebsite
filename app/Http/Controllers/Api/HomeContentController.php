<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FavoriteVideo;
use App\Models\TopFeature;
use App\Models\Video;
use App\Models\VideoSetting;
use App\Models\VideoView;
use Auth;
use Illuminate\Http\Request;

class HomeContentController extends Controller
{
    /**
     * @OA\Get(
     *      path="/home-content",
     *      operationId="index",
     *      tags={"Home Content"},
     *      summary="Get list of Home Content",
     *      description="Returns list of Home Content",
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
            //Start: settings
            $videoSettingsinfo = VideoSetting::where('show_page', 'home')->get();
            //End: settings

            //Start:: favorite video list
            $favoriteList = [];
            if (!empty(Auth()->id())) {
                $favoriteList = FavoriteVideo::where('user_id', Auth()->id())->pluck('video_id', 'video_id')->toArray();
            }
            //End:: favorite video list

            //Start:: top Featured
            $topFeaturedVideoInfo = TopFeature::with(['video'])->get();
            //End:: top Featured

            //Start:: just added video
            $justAddedVideoInfo = Video::where('status', 'active')
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
                ->whereIn('id', $poulerListArr)
                ->take(10)
                ->get();
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
            //End:: trending video

            //Start:: category Video
            $categoryShow  = Category::where('status', 'active')->pluck('name', 'id')->toArray();
            $categoryIdArr = $categoryVideoArr = $categoryVideoDataArr = [];
            $i             = $j             = 0;
            if (!empty($categoryShow)) {
                foreach ($categoryShow as $id => $name) {
                    $categoryIdArr[$i++] = $id;
                }
            }
            $categoryVideoInfo = Video::whereIn('category_id', $categoryIdArr)->get();

            // if (!$categoryVideoInfo->isEmpty()) {
            //     foreach ($categoryVideoInfo as $data) {
            //         // $categoryVideoArr[$categoryShow[$data->category_id]][$j++] = $data;
            //         $categoryVideoArr[$categoryShow[$data->category_id]][$j++] = $data;
            //     }
            // }

            if (!empty($categoryShow)) {
                foreach ($categoryShow as $id => $name) {
                    $categoryVideoDataArr[$j++] = [
                        'name'       => $name,
                        'video_data' => Video::where('category_id', $id)->get(),
                    ];
                }
            }
            // dd($categoryVideoDataArr);
            //End:: category Video

            //Start:: Don't Miss
            $dontMissVideoInfo = Video::inRandomOrder()->take(12)->get();
            //End:: Don't Miss

            return response([
                'status'             => 'success',
                'video_settings'     => $videoSettingsinfo,
                'favorite_list'      => $favoriteList,
                'top_featured_video' => $topFeaturedVideoInfo,
                'just_added_video'   => $justAddedVideoInfo,
                'populer_video'      => $populerVideoInfo,
                'trending_video'     => $trendingVideoInfo,
                'category_video'     => $categoryVideoDataArr,
                'dont_miss_video'    => $dontMissVideoInfo,
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
