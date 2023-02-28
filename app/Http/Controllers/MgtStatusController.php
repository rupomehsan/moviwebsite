<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MgtStatus;
use Illuminate\Http\Request;
use Response;

class MgtStatusController extends Controller
{
    public function status(Request $request)
    {
        // dd($request->all());
        $target = MgtStatus::where('name', $request->name)->first();
        if (!empty($target)) {
            $target->status = $request->status ?? $target->status;
            if ($target->update()) {
                return Response::json(['success' => true], 200);
            }
        } else {
            $mgtStatus         = new MgtStatus;
            $mgtStatus->name   = $request->name;
            $mgtStatus->status = $request->status;
            if ($mgtStatus->save()) {
                return Response::json(['success' => true], 200);
            }

        }
    }

}
