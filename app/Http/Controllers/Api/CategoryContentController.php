<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FavoriteVideo;
use App\Models\SubCategory;
use App\Models\TopFeature;
use App\Models\Video;
use App\Models\VideoSetting;
use App\Models\VideoView;
use Auth;
use Illuminate\Http\Request;

class CategoryContentController extends Controller
{
    /**
     * @OA\Get(
     *      path="/category-content",
     *      operationId="index",
     *      tags={"Category Content"},
     *      summary="Get list of Category Content",
     *      description="Returns list of Category Content",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"category_id"},
     *               @OA\Property(property="category_id", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *  @OA\Response(
     *      response=404,
     *      description="Bad Request"
     *   ),
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
            $existCategory = Category::where('id', $request->category_id)->first();
            if (empty($existCategory)) {
                return response([
                    'status'  => 'error',
                    'message' => 'No category found',
                ], 404);
            }

            //Start: settings
            $videoSettingsinfo = VideoSetting::where('show_page', '!=', 'home')
                ->where('category_id', $request->category_id)->get();
            //End: settings

            //Start:: favorite video list
            $favoriteList = [];
            if (!empty(Auth()->id())) {
                $favoriteList = FavoriteVideo::where('user_id', Auth()->id())->pluck('video_id', 'video_id')->toArray();
            }
            //End:: favorite video list

            //Start:: top Featured
            $topFeaturedVideoInfo = TopFeature::with(['video'])->whereHas('video', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })->get();
            //End:: top Featured

            //Start:: just added video
            $justAddedVideoInfo = Video::where('status', 'active')
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
                ->where('category_id', $request->category_id)
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
                ->where('category_id', $request->category_id)
                ->whereIn('id', $poulerListArr)
                ->take(10)
                ->get();
            // dd($trendingVideoInfo);
            //End:: trending video

            //Start:: category Video
            $subCategoryShow  = SubCategory::where('category_id', $request->category_id)->where('status', 'active')->pluck('name', 'id')->toArray();
            $subCategoryIdArr = $subCategoryVideoDataArr = [];
            $i                = $j                = 0;
            if (!empty($subCategoryShow)) {
                foreach ($subCategoryShow as $id => $name) {
                    $subCategoryIdArr[$i++] = $id;
                }
            }
            $subCategoryVideoInfo = Video::whereIn('sub_category_id', $subCategoryIdArr)->get();

            if (!empty($subCategoryShow)) {
                foreach ($subCategoryShow as $id => $name) {
                    $subCategoryVideoDataArr[$j++] = [
                        'name'       => $name,
                        'video_data' => Video::where('sub_category_id', $id)->get(),
                    ];
                }
            }
            //End:: category Video

            //Start:: Don't Miss
            $dontMissVideoInfo = Video::where('category_id', $request->category_id)->inRandomOrder()->take(12)->get();
            //End:: Don't Miss

            return response([
                'status'             => 'success',
                'video_settings'     => $videoSettingsinfo,
                'favorite_list'      => $favoriteList,
                'top_featured_video' => $topFeaturedVideoInfo,
                'just_added_video'   => $justAddedVideoInfo,
                'populer_video'      => $populerVideoInfo,
                'trending_video'     => $trendingVideoInfo,
                'sub_category_video' => $subCategoryVideoDataArr,
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
