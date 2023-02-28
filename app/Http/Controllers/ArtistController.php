<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Response;
use Session;
use Validator;

class ArtistController extends Controller
{
    public function index(Request $request)
    {
        try {
            $target = Artist::get();
            return view('artist.index')->with(compact('target'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function create(Request $request)
    {

        $view = view('artist.create')->render();
        return response()->json(['html' => $view]);
    }

    public function store(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'name'   => 'required|unique:countries',
                    'image'  => 'required',
                    'status' => Rule::in(['active', 'inactive']),
                ]);

                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                $image     = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalName();
                $image->move('/uploads/artist', $imageName);

                $target         = new Artist;
                $target->name   = $request->name;
                $target->image  = $imageName ?? '';
                $target->status = 'active';
                // $target->updated_by = auth()->id();
                // $target->created_by = auth()->id();
                if ($target->save()) {
                    return Response::json(['success' => true], 200);
                }}
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        $target = Artist::where('id', $request->id)->first();
        $view   = view('artist.edit', compact('target'))->render();
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

    public function update(Request $request)
    {
        try {

            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'name'   => 'required|unique:countries,id,' . $request->id,
                    'status' => Rule::in(['active', 'inactive']),
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                if (!empty($request->file('image'))) {
                    $image     = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    $image->move('/uploads/artist', $imageName);
                }

                $target        = Artist::where('id', $request->id)->first();
                $target->name  = $request->name ?? $target->name;
                $target->image = $imageName ?? $target->image;

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

    public function destroy(Request $request, $id)
    {
        if (auth()->user()->email === 'demoadmin@movieflix.com') {
            return Response::json(['success' => false], 401);
        } else {
            $target = Artist::find($id);

            if (empty($target)) {
                Session::flash('error', 'Invalid Data Id');
            }

            $fileName = 'uploads/artist/' . $target->image;
            if (File::exists($fileName)) {
                File::delete($fileName);
            }

            if ($target->delete()) {
                Session::flash('success', "Artist Deleted Successfully!");
                return redirect()->back();
            } else {
                Session::flash('error', "Artist Delete Unsuccessfully!");
                return redirect()->back();
            }
            return redirect('/artist');
        }
    }

}