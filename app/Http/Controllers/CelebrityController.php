<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Celebrity;
use App\Models\CelebrityType;
use App\Models\MgtStatus;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Response;
use Session;
use Validator;

class CelebrityController extends Controller
{
    // start::celebrity type operations
    public function celebrityTypeCreate(Request $request)
    {

        $view = view('celebrity.typeCreate')->render();
        return response()->json(['html' => $view]);
    }

    public function manageCelebrityType(Request $request)
    {
        $celebrityType = CelebrityType::get();
        $view          = view('celebrity.manageCelebrityType', compact('celebrityType'))->render();
        return response()->json(['html' => $view]);
    }

    public function celebrityTypeStore(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'name'   => 'required|unique:celebrity_types',
                    'status' => Rule::in(['active', 'inactive']),
                ]);

                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                $target         = new CelebrityType;
                $target->name   = $request->name;
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

    public function celebrityTypeEdit(Request $request)
    {
        $target = CelebrityType::where('id', $request->id)->first();
        $view   = view('celebrity.typeEdit', compact('target'))->render();
        return response()->json(['html' => $view]);
    }

    public function celebrityTypeUpdate(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                // dd($request->name);
                $validate = Validator::make(request()->all(), [
                    'name'   => 'required|unique:celebrity_types,id,' . $request->id,
                    'status' => Rule::in(['active', 'inactive']),
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                $target = CelebrityType::where('id', $request->id)->first();
                // dd($target);
                $target->name = $request->name ?? $target->name;

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

    public function celebrityTypeDestroy(Request $request, $id)
    {
        if (auth()->user()->email === 'demoadmin@movieflix.com') {
            return Response::json(['success' => false], 401);
        } else {
            $target = CelebrityType::find($id);

            if (empty($target)) {
                Session::flash('error', 'Invalid Data Id');
            }
            $fileName = 'uploads/celebrity/' . $target->image;
            if (File::exists($fileName)) {
                File::delete($fileName);
            }
            $target->delete();
            return redirect('/admin/celebrity');
        }
    }
    // End::celebrity type operations
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

    // start::celebrity mgt
    public function index(Request $request)
    {
        try {
            $mgtStatus = MgtStatus::where('name', 'celebrity')->first();
            // dd($mgtStatus);
            $firstType = CelebrityType::first();
            $target    = null;

            if ($firstType) {
                $target = Celebrity::join('celebrity_types', 'celebrity_types.id', 'celebrities.celebrity_type_id')
                    ->where('celebrity_type_id', $firstType->id)
                    ->select('celebrities.id', 'celebrities.name', 'celebrities.image', 'celebrity_types.name as celebrity_type'
                        , 'celebrities.file_type', 'celebrities.file_link');

                //begin filtering
                $searchText = $request->fil_search;
                if (!empty($searchText)) {
                    $target->where(function ($query) use ($searchText) {
                        $query->where('celebrities.name', 'LIKE', '%' . $searchText . '%');
                    });
                }
                //end filtering
                $target = $target->get();
            }

            // dd($target);
            $celebrityType = CelebrityType::get();
            return view('celebrity.index')->with(compact('firstType', 'target', 'celebrityType', 'mgtStatus'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function indexView(Request $request)
    {
        try {
            $target = Celebrity::join('celebrity_types', 'celebrity_types.id', 'celebrities.celebrity_type_id')
                ->where('celebrity_type_id', $request->id)
                ->select('celebrities.id', 'celebrities.name', 'celebrities.image', 'celebrity_types.name as celebrity_type'
                    , 'celebrities.file_type', 'celebrities.file_link')->get();
            // dd($target);
            //begin filtering
            // $searchText = $request->fil_search;
            // if (!empty($searchText)) {
            //     $target->where(function ($query) use ($searchText) {
            //         $query->where('celebrities.name', 'LIKE', '%' . $searchText . '%');
            //     });
            // }
            // //end filtering
            // $target = $target->get();

            $celebrityType = CelebrityType::get();
            return view('celebrity.index')->with(compact('target', 'celebrityType'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function create(Request $request)
    {

        $celebrityTypeList = CelebrityType::where('status', 'active')->pluck('name', 'id')->toArray();
        $view              = view('celebrity.create')->with(compact('celebrityTypeList'))->render();
        return response()->json(['html' => $view]);
    }

    public function store(Request $request)
    {
        try {

            $rules = [
                'celebrity_type_id' => 'required|not_in:0',
                'name'              => 'required|unique:celebrities',
                'status'            => Rule::in(['active', 'inactive']),
            ];

            if (($request->file_type) == "file") {
                $rules['image'] = 'required';
            }

            if (($request->file_type) == "link") {
                $rules['file_link'] = 'required';
            }

            $validate = Validator::make(request()->all(), $rules);

            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
            }

            if ($request->file('image')) {
                $folder    = 'celebrity';
                $image     = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalName();
                if (config('app.env') === 'production') {
                    $image->move('uploads/' . $folder, $imageName);
                } else {
                    $image->move(public_path('/uploads/' . $folder), $imageName);
                }
            }

            $target                    = new Celebrity;
            $target->celebrity_type_id = $request->celebrity_type_id;
            $target->name              = $request->name;
            $target->file_type         = $request->file_type;
            $target->file_link         = $request->file_link;
            $target->image             = $imageName ?? '';
            $target->status            = 'active';
            // $target->updated_by = auth()->id();
            // $target->created_by = auth()->id();
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

    public function edit(Request $request)
    {
        $target            = Celebrity::where('id', $request->id)->first();
        $celebrityTypeList = CelebrityType::where('status', 'active')->pluck('name', 'id')->toArray();
        $view              = view('celebrity.edit', compact('target', 'celebrityTypeList'))->render();
        return response()->json(['html' => $view]);
    }

    public function update(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'celebrity_type_id' => 'required|not_in:0',
                    'name'              => 'required|unique:celebrities,id,' . $request->id,
                    'status'            => Rule::in(['active', 'inactive']),
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                if ($request->file('image')) {
                    $folder    = 'celebrity';
                    $image     = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $image->move('uploads/' . $folder, $imageName);
                    } else {
                        $image->move(public_path('/uploads/' . $folder), $imageName);
                    }
                }

                $target                    = Celebrity::where('id', $request->id)->first();
                $target->celebrity_type_id = $request->celebrity_type_id ?? $target->celebrity_type_id;
                $target->name              = $request->name ?? $target->name;
                $target->file_type         = $request->file_type ?? $target->file_type;
                $target->file_link         = $request->file_link ?? $target->file_link;
                $target->image             = $imageName ?? $target->image;

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

    public function destroy(Request $request)
    {
        if (auth()->user()->email === 'demoadmin@movieflix.com') {
            return Response::json(['success' => false], 401);
        } else {
            $target = Celebrity::find($request->id);

            if (empty($target)) {
                Session::flash('error', 'Invalid Data Id');
            }

            $fileName = 'uploads/celebrity/' . $target->image;
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
        return Redirect::to('admin/celebrity?' . $url);
    }
    // End::celebrity mgt

}