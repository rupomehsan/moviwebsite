<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\PackageSubscriber;
use App\Models\Report;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $totalCategory      = Category::count();
        $totalVideo         = Video::count();
        $totalUser          = User::where('user_role_id', '3')->count();
        $totalVideoView     = VideoView::count();
        $lastDayVideoView   = VideoView::where('created_at', '>', now()->subDays(1))->count();
        $lastWeekVideoView  = VideoView::where('created_at', '>', now()->subDays(7))->count();
        $lastMonthVideoView = VideoView::where('created_at', '>', now()->subDays(30))->count();

        $lastDayComment   = Comment::where('created_at', '>', now()->subDays(1))->count();
        $lastWeekComment  = Comment::where('created_at', '>', now()->subDays(7))->count();
        $lastMonthComment = Comment::where('created_at', '>', now()->subDays(30))->count();

        $lastDayReport   = Report::where('created_at', '>', now()->subDays(1))->count();
        $lastWeekReport  = Report::where('created_at', '>', now()->subDays(7))->count();
        $lastMonthReport = Report::where('created_at', '>', now()->subDays(30))->count();

        $firstMonthInfo = VideoView::orderBy('created_at', 'desc')->get();
        $dateList       = [];
        if (!empty($firstMonthInfo)) {
            foreach ($firstMonthInfo as $data) {
                $dateList[$data->created_at->format('Y-m')] = $data->created_at->format('Y-M');
            }
        }
        // dd($dateList);

        $categoryList = Category::where('status', 'active')->get();

        // Start::Top Category
        $categoryViewArr           = $categoryPercentage           = [];
        $thisMonthCategoryViewData = VideoView::join('videos', 'videos.id', 'video_views.video_id')
            ->join('categories', 'categories.id', 'videos.category_id')
            ->whereMonth('video_views.created_at', now()->month)
            ->select('video_views.video_id', 'videos.category_id', 'categories.name as category_name')
            ->get();
        if (!$thisMonthCategoryViewData->isEmpty()) {
            foreach ($thisMonthCategoryViewData as $data) {
                $categoryViewArr[$data->category_id]['this'] = $categoryViewArr[$data->category_id]['this'] ?? 0;
                $categoryViewArr[$data->category_id]['this'] += 1;
            }
        }

        $prevMonthCategoryViewData = VideoView::join('videos', 'videos.id', 'video_views.video_id')
            ->join('categories', 'categories.id', 'videos.category_id')
            ->whereMonth('video_views.created_at', now()->subMonth()->month)
            ->select('video_views.video_id', 'videos.category_id', 'categories.name as category_name')
            ->get();
        if (!$prevMonthCategoryViewData->isEmpty()) {
            foreach ($prevMonthCategoryViewData as $data) {
                $categoryViewArr[$data->category_id]['prev'] = $categoryViewArr[$data->category_id]['prev'] ?? 0;
                $categoryViewArr[$data->category_id]['prev'] += 1;
            }
        }

        if (!empty($categoryViewArr)) {
            foreach ($categoryViewArr as $categoryId => $info) {
                $prevMonth  = $info['prev'] ?? 1;
                $thisMonth  = $info['this'] ?? 1;
                $difference = $thisMonth - $prevMonth;
                if ($difference >= 0) {
                    $categoryPercentage[$categoryId]['type'] = 'increase';
                } else {
                    $categoryPercentage[$categoryId]['type'] = 'decrease';
                }
                $categoryPercentage[$categoryId]['percentage'] = (($difference ?? 1) / $prevMonth) * 100;
            }
        }
        // End::Top Category

        //  Start:: populer Video
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
        //  End:: populer Video

        //unread report
        $unreadReport = Report::where('status', 'active')
            ->where('view_status', 'pending')
            ->count();

        //recent subscriber
        $recentSubscriber = PackageSubscriber::leftJoin('users', 'users.id', 'package_subscribers.user_id')
            ->leftJoin('packages', 'packages.id', 'package_subscribers.package_id')
            ->orderBy('start_date', 'DESC')
            ->select('users.name as user_name', 'users.email as user_email', 'packages.name as package_name'
                , 'package_subscribers.start_date', 'package_subscribers.end_date')
            ->take(10)->get();

        return view('dashboard')->with(compact('totalCategory', 'totalVideo', 'totalUser', 'totalVideoView', 'lastDayVideoView'
            , 'lastWeekVideoView', 'lastMonthVideoView', 'lastDayComment', 'lastWeekComment', 'lastMonthComment', 'lastDayReport'
            , 'lastWeekReport', 'lastMonthReport', 'categoryList', 'categoryPercentage', 'populerVideoInfo', 'populerVideoCount'
            , 'unreadReport', 'recentSubscriber', 'dateList'));
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
    public function getYearlyData(Request $request)
    {
        $yearMonth       = explode("-", $request->year);
        $yearlyVideoView = VideoView::whereMonth('created_at', $yearMonth[1])
            ->whereYear('created_at', $yearMonth[0])
            ->count();

        $yearlyComment = Comment::whereMonth('created_at', $yearMonth[1])
            ->whereYear('created_at', $yearMonth[0])
            ->count();

        $yearlyReport = Report::whereMonth('created_at', $yearMonth[1])
            ->whereYear('created_at', $yearMonth[0])
            ->count();

        return response([
            'status'          => 'success',
            'yearlyVideoView' => $yearlyVideoView,
            'yearlyComment'   => $yearlyComment,
            'yearlyReport'    => $yearlyReport,
        ], 200);
        // dd($yearlyVideoView);
    }
}
