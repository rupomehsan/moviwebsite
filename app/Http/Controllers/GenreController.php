<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\MgtStatus;
use App\Models\Video;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Redirect;
use Response;
use Session;
use Validator;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        try {
            $mgtStatus = MgtStatus::where('name', 'genres')->first();
            $target    = Genre::where('status', 'active');
            //begin filtering
            $searchText = $request->fil_search;
            if (!empty($searchText)) {
                $target->where(function ($query) use ($searchText) {
                    $query->where('name', 'LIKE', '%' . $searchText . '%');
                });
            }
            //end filtering
            $target = $target->get();

            $numberVideo = [];
            $videos      = Video::get();
            if (!$videos->isEmpty()) {
                foreach ($videos as $video) {
                    if (!empty($video->genre_id)) {
                        $genres = json_decode($video->genre_id);
                        if (!empty($genres)) {
                            foreach ($genres as $index => $id) {
                                $numberVideo[$id] = $numberVideo[$id] ?? '0';
                                $numberVideo[$id] += '1';
                            }
                        }

                    }
                }
            }
            // dd($numberVideo);

            return view('genres.index')->with(compact('mgtStatus', 'target', 'numberVideo'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function create(Request $request)
    {

        $view = view('genres.create')->render();
        return response()->json(['html' => $view]);
    }

    public function store(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                // dd($request->all());
                $validate = Validator::make(request()->all(), [
                    'name'   => 'required|unique:genres',
                    // 'image'  => 'required',
                    'status' => Rule::in(['active', 'inactive']),
                ]);

                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                // if ($request->file('image')) {
                //     $folder    = 'genres';
                //     $image     = $request->file('image');
                //     $imageName = time() . '.' . $image->getClientOriginalName();
                //     if (config('app.env') === 'production') {
                //         $image->move('uploads/' . $folder, $imageName);
                //     } else {
                //         $image->move(public_path('/uploads/' . $folder), $imageName);
                //     }
                // }

                $target       = new Genre;
                $target->name = $request->name;
                // $target->image  = $imageName ?? '';
                $target->status = 'active';
                // $target->updated_by = auth()->id();
                // $target->created_by = auth()->id();
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
        $target = Genre::where('id', $request->id)->first();
        $view   = view('genres.edit', compact('target'))->render();
        return response()->json(['html' => $view]);
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

                // if ($request->file('image')) {
                //     $folder    = 'genres';
                //     $image     = $request->file('image');
                //     $imageName = time() . '.' . $image->getClientOriginalName();
                //     if (config('app.env') === 'production') {
                //         $image->move('uploads/' . $folder, $imageName);
                //     } else {
                //         $image->move(public_path('/uploads/' . $folder), $imageName);
                //     }
                // }

                $target       = Genre::where('id', $request->id)->first();
                $target->name = $request->name ?? $target->name;
                // $target->image = $imageName ?? $target->image;

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
            $target = Genre::find($request->id);

            if (empty($target)) {
                Session::flash('error', 'Invalid Data Id');
            }

            $fileName = 'uploads/genres/' . $target->image;
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
        return Redirect::to('admin/genres?' . $url);
    }

}