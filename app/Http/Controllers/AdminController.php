<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Redirect;
use Response;
use Session;
use Validator;

class AdminController extends Controller
{
    public function adminIndex(Request $request)
    {
        $target = User::where('user_role_id', 2)->where('status', 'active');
        //begin filtering
        $searchText = $request->fil_search;
        if (!empty($searchText)) {
            $target->where(function ($query) use ($searchText) {
                $query->where('name', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering

        $target = $target->get();
        return view('admin.adminIndex')->with(compact('target'));
    }

    public function superAdminIndex(Request $request)
    {
        $target = User::where('user_role_id', 1)->where('status', 'active');
        //begin filtering
        $searchText = $request->fil_search;
        if (!empty($searchText)) {
            $target->where(function ($query) use ($searchText) {
                $query->where('name', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering

        $target = $target->get();
        return view('admin.superAdminIndex')->with(compact('target'));
    }

    public function create(Request $request)
    {
        $userRole = UserRole::where('status', 'active')->where('id', '!=', 3)->pluck('name', 'id')->toArray();
        return view('admin.create')->with(compact('userRole'));
    }

    public function store(Request $request)
    {
        try {

            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                Session::flash('error', "Sorry, You can not update this item");
                return redirect('admin');
            } else {
                // dd($request->access);
                $validate = Validator::make(request()->all(), [
                    'user_role_id' => 'required|not_in:0',
                    'name'         => 'required',
                    'email'        => 'required|unique:users|email',
                    'phone'        => 'required',
                    'password'     => 'min:6|required',
                    'image'        => 'required',
                    'status'       => Rule::in(['active', 'inactive']),
                ]);

                // if ($validate->fails()) {
                //     return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                // }

                if ($validate->fails()) {
                    return redirect('admin/admin/create')
                        ->withInput()
                        ->withErrors($validate);
                }

                // dd($request->all());
                $access = '';
                if (!empty($request->access)) {
                    $access = json_encode($request->access);
                }

                if ($request->file('image')) {
                    $folder    = 'user';
                    $image     = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $image->move('uploads/' . $folder, $imageName);
                    } else {
                        $image->move(public_path('/uploads/' . $folder), $imageName);
                    }
                }

                $target                 = new User;
                $target->user_role_id   = $request->user_role_id;
                $target->name           = $request->name;
                $target->email          = $request->email;
                $target->phone          = $request->phone;
                $target->password       = Hash::make($request->password);
                $target->access         = $access;
                $target->image          = $imageName ?? '';
                $target->account_status = 'confirmed';
                $target->status         = 'active';
                // $target->updated_by = auth()->id();
                // $target->created_by = auth()->id();
                if ($target->save()) {
                    Session::flash('success', "Admin Created Successfully!");
                    return redirect('admin/admin');
                } else {
                    Session::flash('error', "Admin Create Unuccessfull!");
                    return redirect('admin/admin/create');
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
        $target = User::where('id', $id)->first();
        $access = [];
        if (!empty($target->access)) {
            $access = json_decode($target->access);
        }
        // dd($access);
        $userRole = UserRole::where('status', 'active')->where('id', '!=', 3)->pluck('name', 'id')->toArray();
        return view('admin.edit')->with(compact('target', 'access', 'userRole'));
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

    public function update(Request $request, $id)
    {
        try {

            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                Session::flash('error', "Sorry, You can not update this item");
                return redirect('admin');
            } else {
                // dd($request->all());

                $validate = Validator::make(request()->all(), [
                    'user_role_id' => 'required|not_in:0',
                    'name'         => 'required',
                    'email'        => 'required|email:rfc,dns|unique:users,id,' . $request->id,
                    'phone'        => 'required',
                    'status'       => Rule::in(['active', 'inactive']),
                ]);

                if ($validate->fails()) {
                    return redirect('admin/admin/' . $request->id . '/edit')
                        ->withInput()
                        ->withErrors($validate);
                }

                if ($request->file('image')) {
                    $folder    = 'user';
                    $image     = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $image->move('uploads/' . $folder, $imageName);
                    } else {
                        $image->move(public_path('/uploads/' . $folder), $imageName);
                    }
                }

                $access = '';
                if (!empty($request->access)) {
                    $access = json_encode($request->access);
                }

                $target               = User::where('id', $request->id)->first();
                $target->user_role_id = $request->user_role_id ?? $target->user_role_id;
                $target->name         = $request->name ?? $target->name;
                $target->email        = $request->email ?? $target->email;
                $target->phone        = $request->phone ?? $target->phone;
                $target->access       = $access;
                $target->image        = $imageName ?? $target->image;

                if ($target->update()) {
                    Session::flash('success', "Admin Updated Successfully!");
                    return redirect('admin/admin');
                } else {
                    Session::flash('error', "Admin Update Unuccessfull!");
                    return redirect('admin/admin/' . $request->id . '/edit');
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
            $target = User::find($request->id);

            if (empty($target)) {
                Session::flash('error', 'Invalid Data Id');
            }

            $fileName = 'uploads/user/' . $target->image;
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
        return Redirect::to('admin/admin?' . $url);
    }
    public function superAdminFilter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('admin/admin/super-admin?' . $url);
    }

    public function adminProfile(Request $request)
    {
        $target = User::where('id', auth()->id())->first();
        // dd($target);
        return view('admin.adminProfile')->with(compact('target'));
    }

}