<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SeriesCategory;
use App\Models\SubCategory;
use App\Models\TvChannelCategory;
use App\Models\Video;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Response;
use Session;
use Validator;

class CategoryController extends Controller
{
    public function categoryIndex(Request $request)
    {
        $target = Category::where('status', 'active');

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
                $numberVideo[$video->category_id] = $numberVideo[$video->category_id] ?? '0';
                $numberVideo[$video->category_id] += '1';

            }
        }
        // dd($numberVideo);

        return view('category.categoryIndex')->with(compact('target', 'numberVideo'));
    }

    public function categoryCreate(Request $request)
    {
        $view = view('category.categoryCreate')->render();
        return response()->json(['html' => $view]);
    }

    public function categoryStore(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'name'   => 'required|unique:categories',
                    // 'image'  => 'required',
                    'status' => Rule::in(['active', 'inactive']),
                ]);

                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                // if ($request->file('image')) {
                //     $folder    = 'category';
                //     $image     = $request->file('image');
                //     $imageName = time() . '.' . $image->getClientOriginalName();
                //     if (config('app.env') === 'production') {
                //         $image->move('uploads/' . $folder, $imageName);
                //     } else {
                //         $image->move(public_path('/uploads/' . $folder), $imageName);
                //     }
                // }

                $target       = new Category;
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

    public function categoryEdit(Request $request)
    {
        $target = Category::where('id', $request->id)->first();
        $view   = view('category.categoryEdit', compact('target'))->render();
        return response()->json(['html' => $view]);
    }

    public function categoryUpdate(Request $request)
    {
        try {

            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'name'   => 'required|unique:categories,id,' . $request->id,
                    'status' => Rule::in(['active', 'inactive']),
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                // if (!empty($request->file('image'))) {
                //     $folder    = 'category';
                //     $image     = $request->file('image');
                //     $imageName = time() . '.' . $image->getClientOriginalName();
                //     if (config('app.env') === 'production') {
                //         $image->move('uploads/' . $folder, $imageName);
                //     } else {
                //         $image->move(public_path('/uploads/' . $folder), $imageName);
                //     }
                // }

                $target       = Category::where('id', $request->id)->first();
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
    public function categoryFilter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('admin/category?' . $url);
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

    //sub category
    public function subCategoryView(Request $request)
    {
        $target = SubCategory::with('category')->where('status', 'active');
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
                if (!empty($video->sub_category_id)) {
                    $numberVideo[$video->sub_category_id] = $numberVideo[$video->sub_category_id] ?? '0';
                    $numberVideo[$video->sub_category_id] += '1';
                }
            }
        }
        // dd($numberVideo);

        return view('category.subCategoryIndex')->with(compact('target', 'numberVideo'));
    }

    public function subCategoryCreate(Request $request)
    {
        $categoryList = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        // dd($categoryList);
        $view = view('category.subCategoryCreate')->with(compact('categoryList'))->render();
        return response()->json(['html' => $view]);
    }

    public function subCategoryStore(Request $request)
    {
        try {
            $validate = Validator::make(request()->all(), [
                'name'        => 'required',
                // 'image'       => 'required',
                'category_id' => 'required|not_in:0',
                'status'      => Rule::in(['active', 'inactive']),
            ]);

            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
            }

            // if ($request->file('image')) {
            //     $folder    = 'category';
            //     $image     = $request->file('image');
            //     $imageName = time() . '.' . $image->getClientOriginalName();
            //     if (config('app.env') === 'production') {
            //         $image->move('uploads/' . $folder, $imageName);
            //     } else {
            //         $image->move(public_path('/uploads/' . $folder), $imageName);
            //     }
            // }

            $target              = new SubCategory;
            $target->category_id = $request->category_id;
            $target->name        = $request->name;
            // $target->image       = $imageName ?? '';
            $target->status = 'active';
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

    public function subCategoryEdit(Request $request)
    {
        $target       = SubCategory::where('id', $request->id)->first();
        $categoryList = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        $view         = view('category.subCategoryEdit', compact('target', 'categoryList'))->render();
        return response()->json(['html' => $view]);
    }

    public function subCategoryUpdate(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'name'   => 'required',
                    'status' => Rule::in(['active', 'inactive']),
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                // if ($request->file('image')) {
                //     $folder    = 'category';
                //     $image     = $request->file('image');
                //     $imageName = time() . '.' . $image->getClientOriginalName();
                //     if (config('app.env') === 'production') {
                //         $image->move('uploads/' . $folder, $imageName);
                //     } else {
                //         $image->move(public_path('/uploads/' . $folder), $imageName);
                //     }
                // }

                $target              = SubCategory::where('id', $request->id)->first();
                $target->category_id = $request->category_id ?? $target->category_id;
                $target->name        = $request->name ?? $target->name;
                // $target->image       = $imageName ?? $target->image;

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

    public function subCategoryFilter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('admin/category/sub-category-view?' . $url);
    }

    //series category
    public function seriesCategoryView(Request $request)
    {
        $target = SeriesCategory::where('status', 'active');
        //begin filtering
        $searchText = $request->fil_search;
        if (!empty($searchText)) {
            $target->where(function ($query) use ($searchText) {
                $query->where('name', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering

        $target = $target->get();
        return view('series.seriesCategoryIndex')->with(compact('target'));
    }

    public function seriesCategoryCreate(Request $request)
    {
        $view = view('series.seriesCategoryCreate')->render();
        return response()->json(['html' => $view]);
    }

    public function seriesCategoryStore(Request $request)
    {
        try {
            $validate = Validator::make(request()->all(), [
                'name'   => 'required|unique:series_categories',
                // 'image'  => 'required',
                'status' => Rule::in(['active', 'inactive']),
            ]);

            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
            }

            // if ($request->file('image')) {
            //     $folder    = 'category';
            //     $image     = $request->file('image');
            //     $imageName = time() . '.' . $image->getClientOriginalName();
            //     if (config('app.env') === 'production') {
            //         $image->move('uploads/' . $folder, $imageName);
            //     } else {
            //         $image->move(public_path('/uploads/' . $folder), $imageName);
            //     }
            // }

            $target       = new SeriesCategory;
            $target->name = $request->name;
            // $target->image  = $imageName ?? '';
            $target->status = 'active';
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

    public function seriesCategoryEdit(Request $request)
    {
        $target = SeriesCategory::where('id', $request->id)->first();
        $view   = view('series.seriesCategoryEdit', compact('target'))->render();
        return response()->json(['html' => $view]);
    }

    public function seriesCategoryUpdate(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'name'   => 'required|unique:series_categories,id,' . $request->id,
                    'status' => Rule::in(['active', 'inactive']),
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                // if ($request->file('image')) {
                //     $folder    = 'category';
                //     $image     = $request->file('image');
                //     $imageName = time() . '.' . $image->getClientOriginalName();
                //     if (config('app.env') === 'production') {
                //         $image->move('uploads/' . $folder, $imageName);
                //     } else {
                //         $image->move(public_path('/uploads/' . $folder), $imageName);
                //     }
                // }

                $target       = SeriesCategory::where('id', $request->id)->first();
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

    public function seriesCategoryFilter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('admin/series/series-category-view?' . $url);
    }
    //tv category
    public function tvCategoryView(Request $request)
    {
        $target = TvChannelCategory::where('status', 'active');
        //begin filtering
        $searchText = $request->fil_search;
        if (!empty($searchText)) {
            $target->where(function ($query) use ($searchText) {
                $query->where('name', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering

        $target = $target->get();
        return view('category.tvCategoryIndex')->with(compact('target'));
    }

    public function tvCategoryCreate(Request $request)
    {
        $view = view('category.tvCategoryCreate')->render();
        return response()->json(['html' => $view]);
    }

    public function tvCategoryStore(Request $request)
    {
        try {
            $validate = Validator::make(request()->all(), [
                'name'   => 'required|unique:tv_channel_categories',
                // 'image'  => 'required',
                'status' => Rule::in(['active', 'inactive']),
            ]);

            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
            }

            // if ($request->file('image')) {
            //     $folder    = 'category';
            //     $image     = $request->file('image');
            //     $imageName = time() . '.' . $image->getClientOriginalName();
            //     if (config('app.env') === 'production') {
            //         $image->move('uploads/' . $folder, $imageName);
            //     } else {
            //         $image->move(public_path('/uploads/' . $folder), $imageName);
            //     }
            // }

            $target       = new TvChannelCategory;
            $target->name = $request->name;
            // $target->image  = $imageName ?? '';
            $target->status = 'active';
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

    public function tvCategoryEdit(Request $request)
    {
        $target = TvChannelCategory::where('id', $request->id)->first();
        $view   = view('category.tvCategoryEdit', compact('target'))->render();
        return response()->json(['html' => $view]);
    }

    public function tvCategoryUpdate(Request $request)
    {
        try {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $validate = Validator::make(request()->all(), [
                    'name'   => 'required|unique:tv_channel_categories,id,' . $request->id,
                    'status' => Rule::in(['active', 'inactive']),
                ]);
                if ($validate->fails()) {
                    return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
                }

                // if ($request->file('image')) {
                //     $folder    = 'category';
                //     $image     = $request->file('image');
                //     $imageName = time() . '.' . $image->getClientOriginalName();
                //     if (config('app.env') === 'production') {
                //         $image->move('uploads/' . $folder, $imageName);
                //     } else {
                //         $image->move(public_path('/uploads/' . $folder), $imageName);
                //     }
                // }

                $target       = TvChannelCategory::where('id', $request->id)->first();
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

    public function tvCategoryFilter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('admin/category/tv-category-view?' . $url);
    }

    //destroy
    public function destroy(Request $request, $model)
    {

        if (auth()->user()->email === 'demoadmin@movieflix.com') {
            return Response::json(['success' => false], 401);
        } else {
            if (auth()->user()->email === 'demoadmin@movieflix.com') {
                return Response::json(['success' => false], 401);
            } else {
                $NamespacedModel = 'App\\Models\\' . $model;
                $target          = $NamespacedModel::find($request->id);

                if (empty($target)) {
                    Session::flash('error', 'Invalid Data Id');
                }
                $fileName = 'uploads/category/' . $target->image;
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

    }

}