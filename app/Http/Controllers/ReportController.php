<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Redirect;
use Response;
use Session;
use Validator;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $target = Report::leftJoin('videos', 'videos.id', 'reports.video_id')
            ->leftJoin('users', 'users.id', 'reports.created_by')
            ->select('reports.id as report_id', 'reports.report as report', 'reports.status as reports_status', 'reports.view_status'
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

        return view('report.index')->with(compact('target'));
    }

    public function status(Request $request)
    {
        $target         = Report::where('id', $request->id)->first();
        $target->status = $request->status ?? $target->status;
        if ($target->update()) {
            return Response::json(['success' => true], 200);
        }
    }

    public function reportShow(Request $request)
    {
        $status              = Report::where('id', $request->id)->first();
        $status->view_status = 'viewed';
        $status->update();

        $target = Report::leftJoin('videos', 'videos.id', 'reports.video_id')
            ->leftJoin('users', 'users.id', 'reports.created_by')
            ->where('reports.id', $request->id)
            ->select('reports.id as report_id', 'reports.report as report', 'reports.status as reports_status', 'videos.title as video', 'users.name as user')
            ->first();

        $view = view('report.reportShow', compact('target'))->render();
        return response()->json(['html' => $view]);

    }

    public function create(Request $request)
    {
        // $target = Report::where('id', $request->id)->first();
        $view = view('report.create', compact('request'))->render();
        return response()->json(['html' => $view]);
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make(request()->all(), [
                'video_id' => 'required',
                'report'   => 'required',
            ]);

            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
            }

            $target              = new Report;
            $target->video_id    = $request->video_id;
            $target->report      = $request->report;
            $target->view_status = 'pending';
            $target->status      = 'active';
            $target->updated_by  = auth()->id();
            $target->created_by  = auth()->id();
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
        $target = Report::where('id', $id)->first();
        return view('report.edit')->with(compact('target'));
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
            // dd($request->all());

            $validate = Validator::make(request()->all(), [
                'name'   => 'required',
                'email'  => 'required|email:rfc,dns|unique:reports,id,' . $request->id,
                'phone'  => 'required',
                'status' => Rule::in(['active', 'inactive']),
            ]);

            if ($validate->fails()) {
                return redirect('report/' . $request->id . '/edit')
                    ->withInput()
                    ->withErrors($validate);
            }

            if (!empty($request->file('image'))) {
                $image     = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalName();
                $image->move('/uploads/report', $imageName);
            }

            $target        = Report::where('id', $request->id)->first();
            $target->name  = $request->name ?? $target->name;
            $target->email = $request->email ?? $target->email;
            $target->phone = $request->phone ?? $target->phone;
            $target->image = $imageName ?? $target->image;

            if ($target->update()) {
                Session::flash('success', "Report Updated Successfully!");
                return redirect('report');
            } else {
                Session::flash('error', "Report Update Unuccessfull!");
                return redirect('report/' . $request->id . '/edit');
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
            $target = Report::find($request->id);
            if (empty($target)) {
                Session::flash('error', 'Invalid Data Id');
            }

            $fileName = 'uploads/report/' . $target->image;
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
        return Redirect::to('admin/report?' . $url);
    }

}
