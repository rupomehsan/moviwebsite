<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Response;
use Validator;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        $target = Subscriber::orderBy('created_at', 'desc')->get();

        return view('subscriber.index')->with(compact('target'));
    }
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $validate = Validator::make(request()->all(), [
                'email' => 'required|unique:subscribers|email:rfc,dns',
            ]);

            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
            }

            $target         = new Subscriber;
            $target->email  = $request->email;
            $target->status = 'active';
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

}
