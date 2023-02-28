<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Redirect;
use Response;
use Session;
use Validator;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        try {
            $target = Package::where('status', 'active');
            //begin filtering
            $searchText = $request->fil_search;
            if (!empty($searchText)) {
                $target->where(function ($query) use ($searchText) {
                    $query->where('name', 'LIKE', '%' . $searchText . '%');
                });
            }
            //end filtering

            $target = $target->get();
            return view('package.index')->with(compact('target'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function create(Request $request)
    {

        $view = view('package.create')->render();
        return response()->json(['html' => $view]);
    }

    public function store(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'name'     => 'required|unique:packages',
                    'validity' => 'required',
                    'price'    => 'required',
                    'status'   => Rule::in(['active', 'inactive']),
                ]);

                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                $target              = new Package;
                $target->name        = $request->name;
                $target->description = $request->description;
                $target->validity    = $request->validity;
                $target->price       = $request->price;
                $target->status      = 'active';
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

    public function edit(Request $request)
    {
        $target = Package::where('id', $request->id)->first();
        $view   = view('package.edit', compact('target'))->render();
        return response()->json(['html' => $view]);
    }

    public function update(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'name'     => 'required|unique:packages,id,' . $request->id,
                    'validity' => 'required',
                    'price'    => 'required',
                    'status'   => Rule::in(['active', 'inactive']),
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                $target              = Package::where('id', $request->id)->first();
                $target->name        = $request->name ?? $target->name;
                $target->description = $request->description ?? $target->description;
                $target->validity    = $request->validity ?? $target->validity;
                $target->price       = $request->price ?? $target->price;
                $target->status      = $request->status ?? $target->status;

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

    public function destroy(Request $request)
    {
        if (auth()->user()->email === 'demoadmin@movieflix.com') {
            return Response::json(['success' => false], 401);
        } else {
            $target = Package::find($request->id);

            if (empty($target)) {
                Session::flash('error', 'Invalid Data Id');
            }

            if ($target->delete()) {
                return Response::json(['success' => true], 200);
            } else {
                return Response::json(['success' => false], 404);
            }
        }
        // return redirect('/package');
    }

    public function filter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('admin/package?' . $url);
    }

}
