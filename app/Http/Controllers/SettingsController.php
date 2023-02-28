<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Setting;
use App\Models\SmtpSetting;
use App\Models\SubCategory;
use App\Models\VideoSetting;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Response;
use Session;
use Validator;

class SettingsController extends Controller
{
    public function basicSettings(Request $request)
    {
        $target = Setting::first();
        // dd($target);
        return view('settings.basicSettings')->with(compact('target'));
    }
    public function addSocialAccount(Request $request)
    {
        // dd('dddd');
        $view = view('settings.socialAccount')->render();
        return response()->json(['html' => $view]);
    }
    public function addSocial(Request $request)
    {
        // dd($request->all());

        $validate = Validator::make(request()->all(), [
            'name'  => 'required',
            'image' => 'required',
        ]);

        if ($validate->fails()) {
            return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
        }

        if ($request->file('image')) {
            $folder    = 'settings';
            $image     = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalName();
            if (config('app.env') === 'production') {
                $image->move('uploads/' . $folder, $imageName);
            } else {
                $image->move(public_path('/uploads/' . $folder), $imageName);
            }
        }
        $data['name']  = $request->name;
        $data['link']  = $request->link;
        $data['image'] = $imageName;

        return response()->json(['data' => $data]);
    }
    public function basicSettingsUpdate(Request $request)
    {
        try {
            // dd($request->all());
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                Session::flash('error', "Sorry, You can not update this item");
                return redirect('admin/basic-settings');
            } else {

                $rules = [
                    'system_name'  => 'required',
                    'app_version'  => 'required',
                    'mail_address' => 'required',
                    'developed_by' => 'required',
                    'copyright'    => 'required',
                    // 'privacy_policy' => 'required',
                    // 'terms_policy'   => 'required',
                ];
                if (($request->is_parental_control) == "on") {
                    $rules['parental_password'] = 'required';
                }

                $validate = Validator::make(request()->all(), $rules);
                if ($validate->fails()) {
                    return redirect('admin/basic-settings')
                        ->withInput()
                        ->withErrors($validate);
                }

                $imageName = '';
                if ($request->file('logo')) {
                    $folder    = '';
                    $image     = $request->file('logo');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $image->move('uploads/', $imageName);
                    } else {
                        $image->move(public_path('/uploads/'), $imageName);
                    }
                }

                $imageNameIcon = '';
                if (!empty($request->file('logo_icon'))) {
                    $image         = $request->file('logo_icon');
                    $imageNameIcon = time() . '.' . $image->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $image->move('uploads/', $imageName);
                    } else {
                        $image->move(public_path('/uploads/'), $imageName);
                    }
                }
                // dd($imageName, $imageNameIcon);

                $target = Setting::first();
                if ($target) {
                    $target->system_name  = $request->system_name ?? $target->system_name;
                    $target->app_version  = $request->app_version ?? $target->app_version;
                    $target->logo         = $imageName ?? $target->logo;
                    $target->logo_icon    = $imageNameIcon ?? $target->logo_icon;
                    $target->copyright    = $request->copyright ?? $target->copyright;
                    $target->mail_address = $request->mail_address ?? $target->mail_address;
                    $target->developed_by = $request->developed_by ?? $target->developed_by;
                    $target->website      = $request->website ?? $target->website;
                    $target->update_app   = $request->update_app;

                    $target->facebook  = $request->facebook;
                    $target->instagram = $request->instagram;
                    $target->twitter   = $request->twitter;
                    $target->youtube   = $request->youtube;

                    $target->is_parental_control = $request->is_parental_control ?? 'off';
                    $target->parental_password   = $request->parental_password;

                    $target->description    = $request->description;
                    $target->about_us       = $request->about_us;
                    $target->privacy_policy = $request->privacy_policy ?? $target->privacy_policy;
                    $target->cookies_policy = $request->cookies_policy;
                    $target->terms_policy   = $request->terms_policy ?? $target->terms_policy;

                    $target->seo_title        = $request->seo_title;
                    $target->meta_description = $request->meta_description;
                    $target->focus_keyword    = $request->focus_keyword;
                    $target->seo_tag          = $request->seo_tag;
                    if ($target->update()) {
                        Session::flash('success', "Basic Settings Updated Successfully!");
                        return redirect('admin/basic-settings');
                    } else {
                        Session::flash('error', "Basic Settings  Update Unsuccessfull!");
                        return redirect('admin/basic-settings');
                    }
                } else {
                    $target               = new Setting();
                    $target->system_name  = $request->system_name;
                    $target->app_version  = $request->app_version;
                    $target->logo         = $imageName;
                    $target->logo_icon    = $imageNameIcon;
                    $target->copyright    = $request->copyright;
                    $target->mail_address = $request->mail_address;
                    $target->developed_by = $request->developed_by;
                    $target->website      = $request->website;
                    $target->update_app   = $request->update_app;

                    $target->facebook  = $request->facebook;
                    $target->instagram = $request->instagram;
                    $target->twitter   = $request->twitter;
                    $target->youtube   = $request->youtube;

                    $target->is_parental_control = $request->is_parental_control ?? '';
                    $target->parental_password   = $request->parental_password;

                    $target->description    = $request->description;
                    $target->about_us       = $request->about_us;
                    $target->privacy_policy = $request->privacy_policy;
                    $target->cookies_policy = $request->cookies_policy;
                    $target->terms_policy   = $request->terms_policy;

                    $target->seo_title        = $request->seo_title;
                    $target->meta_description = $request->meta_description;
                    $target->focus_keyword    = $request->focus_keyword;
                    $target->seo_tag          = $request->seo_tag;
                    if ($target->save()) {
                        Session::flash('success', "Basic Settings Updated Successfully!");
                        return redirect('admin/basic-settings');
                    } else {
                        Session::flash('error', "Basic Settings  Update Unsuccessfull!");
                        return redirect('admin/basic-settings');
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
    public function smtpUpdate(Request $request)
    {
        // dd($request->all());
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {

                $validate = Validator::make(request()->all(), [
                    'type'       => 'required',
                    'host'       => 'required',
                    'email'      => 'required',
                    'password'   => 'required',
                    'encryption' => 'required|not_in:0',
                    'port'       => 'required',
                ]);

                if ($validate->fails()) {
                    return redirect('admin/smtp-settings')
                        ->withInput()
                        ->withErrors($validate);
                }

                $setting = SmtpSetting::first();

                if (empty($setting)) {
                    $setting             = new SmtpSetting;
                    $setting->type       = $request->type;
                    $setting->host       = $request->host;
                    $setting->email      = $request->email;
                    $setting->password   = $request->password;
                    $setting->encryption = $request->encryption;
                    $setting->port       = $request->port;
                    if ($setting->save()) {
                        Session::flash('success', "SMTP Settings Updated Successfully!");
                        return redirect('admin/smtp-settings');

                    }
                } else {
                    $setting->type       = $request->type ?? $setting->type;
                    $setting->host       = $request->host ?? $setting->host;
                    $setting->email      = $request->email ?? $setting->email;
                    $setting->password   = $request->password ?? $setting->password;
                    $setting->encryption = $request->encryption ?? $setting->encryption;
                    $setting->port       = $request->port ?? $setting->port;
                    if ($setting->update()) {
                        Session::flash('success', "SMTP Settings Updated Successfully!");
                        return redirect('admin/smtp-settings');
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

    public function videoSettings(Request $request)
    {
        $target       = VideoSetting::where('show_page', 'home')->get();
        $categoryList = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        // dd($categoryList);
        return view('settings.videoSettings')->with(compact('target', 'categoryList'));
    }
    public function getCategoryContent(Request $request)
    {
        $target   = VideoSetting::where('show_page', 'home')->get();
        $category = Category::where('id', $request->category_id)->first();
        // dd($category);
        $view = view('settings.getCategoryContent', compact('target', 'category'))->render();
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

    public function videoSettingsCategory(Request $request)
    {
        $categoryList = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        return view('settings.videoSettingsCategory')->with(compact('categoryList'));
    }

    public function getSettingsCategory(Request $request)
    {
        // dd($request->all());
        $category = Category::where('id', $request->category_id)->first();
        $target   = VideoSetting::where('show_page', '!=', 'home')
            ->where('category_id', $request->category_id)
            ->get();
        $subCategoryList = SubCategory::where('category_id', $request->category_id)
            ->where('status', 'active')
            ->pluck('name', 'id')->toArray();

        $view = view('settings.getSettingsCategory', compact('category', 'target', 'subCategoryList'))->render();
        return response()->json(['html' => $view]);
    }
    public function getSubCategoryContent(Request $request)
    {
        $subCategory = SubCategory::where('id', $request->sub_category_id)->first();
        // dd($category);
        $view = view('settings.getSubCategoryContent', compact('subCategory'))->render();
        return response()->json(['html' => $view]);
    }

    public function videoSettingsUpdate(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                Session::flash('error', "Sorry, You can not update this item");
                return redirect()->back();
            } else {
                // dd($request->all());
                $data = $target = [];
                if (!empty($request->name)) {
                    foreach ($request->name as $name) {
                        $data[$name]['show_page']  = $request->show_page;
                        $data[$name]['name']       = $name;
                        $data[$name]['created_at'] = date('Y-m-d H:i:s');
                        $data[$name]['updated_at'] = date('Y-m-d H:i:s');
                        if ($request->show_page != 'home') {
                            $data[$name]['category_id'] = $request->category_id;
                        }
                    }
                }
                if (!empty($request->vertical_image)) {
                    foreach ($request->vertical_image as $name => $image) {
                        $data[$name]['vertical_image'] = $image ?? 'off';
                    }
                }
                if (!empty($request->horizontal_image)) {
                    foreach ($request->horizontal_image as $name => $image) {
                        $data[$name]['horizontal_image'] = $image ?? 'off';
                    }
                }
                if (!empty($request->video_number)) {
                    foreach ($request->video_number as $name => $number) {
                        $data[$name]['video_number'] = $number ?? 0;
                    }
                }
                if ((!empty($request->category_id)) && ($request->show_page == 'home')) {
                    foreach ($request->category_id as $name => $id) {
                        $data[$name]['category_id'] = $id ?? 0;
                    }
                }
                if (!empty($request->sub_category_id)) {
                    foreach ($request->sub_category_id as $name => $id) {
                        $data[$name]['sub_category_id'] = $id ?? 0;
                    }
                }

                if (!empty($data)) {
                    foreach ($data as $fieldName => $column) {
                        $target[$fieldName]['show_page']        = $column['show_page'];
                        $target[$fieldName]['category_id']      = $column['category_id'] ?? '0';
                        $target[$fieldName]['sub_category_id']  = $column['sub_category_id'] ?? '0';
                        $target[$fieldName]['name']             = $column['name'];
                        $target[$fieldName]['vertical_image']   = $column['vertical_image'] ?? 'off';
                        $target[$fieldName]['horizontal_image'] = $column['horizontal_image'] ?? 'off';
                        $target[$fieldName]['video_number']     = $column['video_number'] ?? '0';
                        $target[$fieldName]['created_at']       = $column['created_at'];
                        $target[$fieldName]['updated_at']       = $column['updated_at'];
                    }
                }

                // dd($target);

                VideoSetting::where('show_page', $request->show_page)->delete();

                if (VideoSetting::insert($target)) {
                    Session::flash('success', "Video Settings Updated Successfully!");
                    return redirect()->back();
                } else {
                    Session::flash('error', "Video Settings  Update Unsuccessfull!");
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
