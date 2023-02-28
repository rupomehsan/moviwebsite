<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Response;
use Session;
use Validator;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $target = Comment::leftJoin('videos', 'videos.id', 'comments.video_id')
            ->join('users', 'users.id', 'comments.created_by')
            ->select('comments.id as comment_id', 'comments.comment as comment', 'comments.status as comments_status'
                , 'videos.title as video', 'users.name as user');

        //begin filtering
        $searchText = $request->fil_search;
        if (!empty($searchText)) {
            $target->where(function ($query) use ($searchText) {
                $query->where('users.name', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering

        $target = $target->get();

        return view('comment.index')->with(compact('target'));
    }

    public function status(Request $request)
    {
        $target         = Comment::where('id', $request->id)->first();
        $target->status = $request->status ?? $target->status;
        if ($target->update()) {
            return Response::json(['success' => true], 200);
        }
    }

    public function create(Request $request)
    {
        return view('comment.create');
    }

    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $validate = Validator::make(request()->all(), [
                'comment' => 'required',
            ]);

            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
            }

            $target             = new Comment;
            $target->video_id   = $request->video_id;
            $target->comment    = $request->comment;
            $target->status     = 'active';
            $target->updated_by = auth()->id();
            $target->created_by = auth()->id();
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

    public function edit(Request $request, $id)
    {
        $target = Comment::where('id', $id)->first();
        return view('comment.edit')->with(compact('target'));
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
                return Response::json(['success' => false], 401);
            } else {
                // dd($request->all());

                $validate = Validator::make(request()->all(), [
                    'name'   => 'required',
                    'email'  => 'required|email:rfc,dns|unique:comments,id,' . $request->id,
                    'phone'  => 'required',
                    'status' => Rule::in(['active', 'inactive']),
                ]);

                if ($validate->fails()) {
                    return redirect('comment/' . $request->id . '/edit')
                        ->withInput()
                        ->withErrors($validate);
                }

                if (!empty($request->file('image'))) {
                    $image     = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    $image->move('/uploads/comment', $imageName);
                }

                $target        = Comment::where('id', $request->id)->first();
                $target->name  = $request->name ?? $target->name;
                $target->email = $request->email ?? $target->email;
                $target->phone = $request->phone ?? $target->phone;
                $target->image = $imageName ?? $target->image;

                if ($target->update()) {
                    Session::flash('success', "Comment Updated Successfully!");
                    return redirect('comment');
                } else {
                    Session::flash('error', "Comment Update Unuccessfull!");
                    return redirect('comment/' . $request->id . '/edit');
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
            $target = Comment::find($request->id);

            if (empty($target)) {
                Session::flash('error', 'Invalid Data Id');
            }

            $fileName = 'uploads/comment/' . $target->image;
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
        return Redirect::to('admin/comment?' . $url);
    }

}
