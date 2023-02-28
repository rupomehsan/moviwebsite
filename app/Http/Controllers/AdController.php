<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MobileAd;
use App\Models\WebAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Response;
use Session;

class AdController extends Controller
{
    public function mobileAd(Request $request)
    {
        $target = MobileAd::get();
        return view('advertisement.mobileAd')->with(compact('target'));
    }
    public function mobileAdUpdate(Request $request)
    {
        try {

            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                Session::flash('error', "Sorry, You can not update this item");
                redirect()->back();
            } else {

                $data = $target = [];
                // dd($request->all());
                if (!empty($request->banner_image)) {
                    $image     = $request->banner_image['custom'];
                    $imageName = time() . '.' . $image->getClientOriginalName();

                    if (config('app.env') === 'production') {
                        $image->move('uploads/ad', $imageName);
                    } else {
                        $image->move(public_path('/uploads/ad'), $imageName);
                    }
                    $data['custom']['banner_image'] = $imageName;
                }
                if (!empty($request->interesticial_image)) {
                    $image     = $request->interesticial_image['custom'];
                    $imageName = time() . '.' . $image->getClientOriginalName();

                    if (config('app.env') === 'production') {
                        $image->move('uploads/ad', $imageName);
                    } else {
                        $image->move(public_path('/uploads/ad'), $imageName);
                    }
                    $data['custom']['interesticial_image'] = $imageName;
                }
                if (!empty($request->native_image)) {
                    $image     = $request->native_image['custom'];
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    $image->move('/uploads/ad', $imageName);
                    $data['custom']['native_image'] = $imageName;
                }
                if (!empty($request->app_open_image)) {
                    $image     = $request->app_open_image['custom'];
                    $imageName = time() . '.' . $image->getClientOriginalName();

                    if (config('app.env') === 'production') {
                        $image->move('uploads/ad', $imageName);
                    } else {
                        $image->move(public_path('/uploads/ad'), $imageName);
                    }
                    $data['custom']['app_open_image'] = $imageName;
                }

                // dd($data);

                if (!empty($request->ad_type)) {
                    foreach ($request->ad_type as $adType) {
                        $data[$adType]['ad_type']    = $adType;
                        $data[$adType]['created_at'] = date('Y-m-d H:i:s');
                        $data[$adType]['updated_at'] = date('Y-m-d H:i:s');
                    }
                }
                if (!empty($request->google_status)) {
                    foreach ($request->google_status as $adType => $google) {
                        $data[$adType]['google_status'] = $google ?? '';
                    }
                }
                if (!empty($request->facebook_status)) {
                    foreach ($request->facebook_status as $adType => $facebook) {
                        $data[$adType]['facebook_status'] = $facebook ?? null;
                    }
                }
                if (!empty($request->custom_status)) {
                    foreach ($request->custom_status as $adType => $custom) {
                        $data[$adType]['custom_status'] = $custom ?? null;
                    }
                }
                if (!empty($request->startup_status)) {
                    foreach ($request->startup_status as $adType => $startup) {
                        $data[$adType]['startup_status'] = $startup ?? null;
                    }
                }
                if (!empty($request->unity_status)) {
                    foreach ($request->unity_status as $adType => $unity) {
                        $data[$adType]['unity_status'] = $unity ?? null;
                    }
                }
                if (!empty($request->app_lovin_max_status)) {
                    foreach ($request->app_lovin_max_status as $adType => $app_lovin_max_status) {
                        $data[$adType]['app_lovin_max_status'] = $app_lovin_max_status ?? null;
                    }
                }
                if (!empty($request->iron_status)) {
                    foreach ($request->iron_status as $adType => $iron) {
                        $data[$adType]['iron_status'] = $iron ?? null;
                    }
                }
                if (!empty($request->next_status)) {
                    foreach ($request->next_status as $adType => $next) {
                        $data[$adType]['next_status'] = $next ?? null;
                    }
                }
                if (!empty($request->banner_id)) {
                    foreach ($request->banner_id as $adType => $banner) {
                        $data[$adType]['banner_id'] = $banner ?? null;
                    }
                }
                if (!empty($request->banner_link)) {
                    foreach ($request->banner_link as $adType => $banlink) {
                        $data[$adType]['banner_link'] = $banlink ?? null;
                    }
                }
                if (!empty($request->app_open_id)) {
                    foreach ($request->app_open_id as $adType => $app_open) {
                        $data[$adType]['app_open_id'] = $app_open ?? null;
                    }
                }
                if (!empty($request->banner_link)) {
                    foreach ($request->banner_link as $adType => $banlink) {
                        $data[$adType]['banner_link'] = $banlink ?? null;
                    }
                }
                if (!empty($request->interesticial_id)) {
                    foreach ($request->interesticial_id as $adType => $interesticial_id) {
                        $data[$adType]['interesticial_id'] = $interesticial_id ?? null;
                    }
                }
                if (!empty($request->interesticial_link)) {
                    foreach ($request->interesticial_link as $adType => $interesticial_link) {
                        $data[$adType]['interesticial_link'] = $interesticial_link ?? null;
                    }
                }
                if (!empty($request->interesticial_click)) {
                    foreach ($request->interesticial_click as $adType => $interesticial_click) {
                        $data[$adType]['interesticial_click'] = $interesticial_click ?? 0;
                    }
                }
                if (!empty($request->native_id)) {
                    foreach ($request->native_id as $adType => $native_id) {
                        $data[$adType]['native_id'] = $native_id ?? null;
                    }
                }
                if (!empty($request->native_link)) {
                    foreach ($request->native_link as $adType => $native_link) {
                        $data[$adType]['native_link'] = $native_link ?? null;
                    }
                }
                if (!empty($request->native_per_video_like)) {
                    foreach ($request->native_per_video_like as $adType => $native_per_video_like) {
                        $data[$adType]['native_per_video_like'] = $native_per_video_like ?? 0;
                    }
                }
                if (!empty($request->native_per_video_series)) {
                    foreach ($request->native_per_video_series as $adType => $native_per_video_series) {
                        $data[$adType]['native_per_video_series'] = $native_per_video_series ?? 0;
                    }
                }
                if (!empty($request->startup_id)) {
                    foreach ($request->startup_id as $adType => $startup_id) {
                        $data[$adType]['startup_id'] = $startup_id ?? null;
                    }
                }
                if (!empty($request->unity_id)) {
                    foreach ($request->unity_id as $adType => $unity_id) {
                        $data[$adType]['unity_id'] = $unity_id ?? null;
                    }
                }
                if (!empty($request->iron_id)) {
                    foreach ($request->iron_id as $adType => $iron_id) {
                        $data[$adType]['iron_id'] = $iron_id ?? null;
                    }
                }
                if (!empty($request->next_id)) {
                    foreach ($request->next_id as $adType => $next_id) {
                        $data[$adType]['next_id'] = $next_id ?? null;
                    }
                }
                // dd($data);

                $prevImg = MobileAd::where('ad_type', 'custom')->first();

                if (!empty($data)) {
                    foreach ($data as $fieldName => $column) {
                        $target[$fieldName]['ad_type'] = $column['ad_type'];

                        $target[$fieldName]['google_status']        = $column['google_status'] ?? 'off';
                        $target[$fieldName]['facebook_status']      = $column['facebook_status'] ?? 'off';
                        $target[$fieldName]['custom_status']        = $column['custom_status'] ?? 'off';
                        $target[$fieldName]['startup_status']       = $column['startup_status'] ?? 'off';
                        $target[$fieldName]['unity_status']         = $column['unity_status'] ?? 'off';
                        $target[$fieldName]['iron_status']          = $column['iron_status'] ?? 'off';
                        $target[$fieldName]['next_status']          = $column['next_status'] ?? 'off';
                        $target[$fieldName]['app_lovin_max_status'] = $column['app_lovin_max_status'] ?? 'off';

                        $target[$fieldName]['banner_id']    = $column['banner_id'] ?? null;
                        $target[$fieldName]['banner_link']  = $column['banner_link'] ?? null;
                        $target[$fieldName]['banner_image'] = $column['banner_image'] ?? ((!empty($prevImg->banner_image) && ($fieldName == 'custom')) ? $prevImg->banner_image : null);

                        $target[$fieldName]['interesticial_id']    = $column['interesticial_id'] ?? null;
                        $target[$fieldName]['interesticial_link']  = $column['interesticial_link'] ?? null;
                        $target[$fieldName]['interesticial_image'] = $column['interesticial_image'] ?? ((!empty($prevImg->interesticial_image) && ($fieldName == 'custom')) ? $prevImg->interesticial_image : null);
                        $target[$fieldName]['interesticial_click'] = $column['interesticial_click'] ?? 0;

                        $target[$fieldName]['native_id']               = $column['native_id'] ?? null;
                        $target[$fieldName]['native_link']             = $column['native_link'] ?? null;
                        $target[$fieldName]['native_image']            = $column['native_image'] ?? ((!empty($prevImg->native_image) && ($fieldName == 'custom')) ? $prevImg->native_image : null);
                        $target[$fieldName]['native_per_video_like']   = $column['native_per_video_like'] ?? 0;
                        $target[$fieldName]['native_per_video_series'] = $column['native_per_video_series'] ?? 0;

                        $target[$fieldName]['app_open_id']    = $column['app_open_id'] ?? null;
                        $target[$fieldName]['app_open_link']  = $column['app_open_link'] ?? null;
                        $target[$fieldName]['app_open_image'] = $column['app_open_image'] ?? ((!empty($prevImg->app_open_image) && ($fieldName == 'custom')) ? $prevImg->app_open_image : null);

                        $target[$fieldName]['startup_id'] = $column['startup_id'] ?? null;
                        $target[$fieldName]['unity_id']   = $column['unity_id'] ?? null;
                        $target[$fieldName]['iron_id']    = $column['iron_id'] ?? null;
                        $target[$fieldName]['next_id']    = $column['next_id'] ?? null;

                        $target[$fieldName]['created_at'] = $column['created_at'];
                        $target[$fieldName]['updated_at'] = $column['updated_at'];
                    }
                }

                // echo '<pre>';
                // print_r($target);exit;
                // dd($target);
                // dd($target);

                $prev = MobileAd::first();
                if (!empty($prev)) {
                    MobileAd::truncate();
                }

                if (MobileAd::insert($target)) {
                    Session::flash('success', "Advertisement Updated Successfully!");
                    return redirect()->back();
                } else {
                    Session::flash('error', "Advertisement  Update Unsuccessfull!");
                    return redirect()->back();
                }
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function webAd(Request $request)
    {
        $adsenseSizeArr = [
            '120*90', '120*240', '120*600', '125*125', '160*90', '160*600',
            '180*90', '180*150', '200*90', '200*200', '234*60', '250*250',
            '320*100', '300*250', '300*600', '300*1050', '320*50', '336*280',
            '360*300', '435*300', '468*15', '468*60', '640*165', '640*190',
            '640*300', '728*15', '728*90', '970*90', '970*250', '240*400-Regional ad size',
            '250*360-Regional ad size', '580*400-Regional ad size', '750*100-Regional ad size', '750*200-Regional ad size',
            '750*300-Regional ad size', '980*120-Regional ad size', '930*180-Regional ad size',
        ];
        $target = WebAd::get();
        return view('advertisement.webAd')->with(compact('target', 'adsenseSizeArr'));
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

    public function webAdUpdate(Request $request)
    {
        try {

            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                Session::flash('error', "Sorry, You can not update this item");
                redirect()->back();
            } else {
                // dd($request->all());

                $data = $target = [];
                if (!empty($request->ad_type)) {
                    foreach ($request->ad_type as $adType) {
                        $data[$adType]['ad_type']    = $adType;
                        $data[$adType]['created_at'] = date('Y-m-d H:i:s');
                        $data[$adType]['updated_at'] = date('Y-m-d H:i:s');
                    }
                }
                if (!empty($request->add_link)) {
                    foreach ($request->add_link as $adType => $link) {
                        $data[$adType]['add_link'] = $link ?? null;
                    }
                }
                if (!empty($request->add_title)) {
                    foreach ($request->add_title as $adType => $title) {
                        $data[$adType]['add_title'] = $title ?? null;
                    }
                }
                if (!empty($request->show_per_video_category)) {
                    foreach ($request->show_per_video_category as $adType => $title) {
                        $data[$adType]['show_per_video_category'] = $title ?? null;
                    }
                }
                if (!empty($request->disable_desktop)) {
                    foreach ($request->disable_desktop as $adType => $desktop) {
                        $data[$adType]['disable_desktop'] = $desktop ?? null;
                    }
                }
                if (!empty($request->disable_tablet_landscape)) {
                    foreach ($request->disable_tablet_landscape as $adType => $tabletLand) {
                        $data[$adType]['disable_tablet_landscape'] = $tabletLand ?? null;
                    }
                }
                if (!empty($request->disable_tablet_portrait)) {
                    foreach ($request->disable_tablet_portrait as $adType => $tabletPort) {
                        $data[$adType]['disable_tablet_portrait'] = $tabletPort ?? null;
                    }
                }
                if (!empty($request->disable_phone)) {
                    foreach ($request->disable_phone as $adType => $phone) {
                        $data[$adType]['disable_phone'] = $phone ?? null;
                    }
                }

                if (!empty($request->desktop_adsense)) {
                    foreach ($request->desktop_adsense as $adType => $desktop) {
                        $data[$adType]['desktop_adsense'] = $desktop ?? null;
                    }
                }
                if (!empty($request->tablet_landscape_adsense)) {
                    foreach ($request->tablet_landscape_adsense as $adType => $tabletLand) {
                        $data[$adType]['tablet_landscape_adsense'] = $tabletLand ?? null;
                    }
                }
                if (!empty($request->tablet_portrait_adsense)) {
                    foreach ($request->tablet_portrait_adsense as $adType => $tabletPort) {
                        $data[$adType]['tablet_portrait_adsense'] = $tabletPort ?? null;
                    }
                }
                if (!empty($request->phone_adsense)) {
                    foreach ($request->phone_adsense as $adType => $phone) {
                        $data[$adType]['phone_adsense'] = $phone ?? null;
                    }
                }

                //image
                if (!empty($request->image)) {
                    foreach ($request->image as $adType => $img) {
                        $image     = $img;
                        $imageName = time() . '.' . $image->getClientOriginalName();

                        if (config('app.env') === 'production') {
                            $image->move('uploads/ad', $imageName);
                        } else {
                            $image->move(public_path('/uploads/ad'), $imageName);
                        }
                        // $image->move('/uploads/ad', $imageName);
                        $data[$adType]['image'] = $imageName;
                    }
                }

                //custom status
                if (!empty($request->status)) {
                    $data['custom_header']['status']         = 'on';
                    $data['custom_after_category']['status'] = 'on';
                    $data['custom_native_like']['status']    = 'on';
                    $data['custom_native_series']['status']  = 'on';
                } else {
                    $data['header']['status']         = 'on';
                    $data['after_category']['status'] = 'on';
                    $data['native_like']['status']    = 'on';
                    $data['native_series']['status']  = 'on';
                }
                $data['popup']['status'] = 'on';

                $prevImg = WebAd::pluck('image', 'ad_type')->toArray();
                // dd($data);

                if (!empty($data)) {
                    foreach ($data as $fieldName => $column) {
                        $target[$fieldName]['ad_type'] = $column['ad_type'];
                        $target[$fieldName]['status']  = $column['status'] ?? 'off';

                        $target[$fieldName]['ad_link']                 = $column['add_link'] ?? null;
                        $target[$fieldName]['ad_title']                = $column['add_title'] ?? null;
                        $target[$fieldName]['show_per_video_category'] = $column['show_per_video_category'] ?? null;
                        $target[$fieldName]['image']                   = $column['image'] ?? ($prevImg[$fieldName] ?? null);

                        $target[$fieldName]['disable_desktop']          = $column['disable_desktop'] ?? 'off';
                        $target[$fieldName]['disable_tablet_landscape'] = $column['disable_tablet_landscape'] ?? 'off';
                        $target[$fieldName]['disable_tablet_portrait']  = $column['disable_tablet_portrait'] ?? 'off';
                        $target[$fieldName]['disable_phone']            = $column['disable_phone'] ?? 'off';

                        $target[$fieldName]['desktop_adsense']          = $column['desktop_adsense'] ?? null;
                        $target[$fieldName]['tablet_landscape_adsense'] = $column['tablet_landscape_adsense'] ?? null;
                        $target[$fieldName]['tablet_portrait_adsense']  = $column['tablet_portrait_adsense'] ?? null;
                        $target[$fieldName]['phone_adsense']            = $column['phone_adsense'] ?? null;

                        $target[$fieldName]['created_at'] = $column['created_at'];
                        $target[$fieldName]['updated_at'] = $column['updated_at'];
                    }
                }
                // dd($target);

                $prev = WebAd::first();
                if (!empty($prev)) {
                    WebAd::truncate();
                }

                if (WebAd::insert($target)) {
                    Session::flash('success', "Advertisement Updated Successfully!");
                    return redirect()->back();
                } else {
                    Session::flash('error', "Advertisement  Update Unsuccessfull!");
                    return redirect()->back();
                }
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
