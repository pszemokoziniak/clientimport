<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Illuminate\Support\Facades\Session;

class StatusController extends Controller
{
    function index() {
        return view('statusAdd');
    }

    function addStatus(Request $req){
        $status = new Status;
        $status->status=$req->status;
        $status->save();
        return redirect("statusList");
    }

    function list() {
        $data = Status::all();
        return view('statusList',["data"=>$data]);
    }
    function delete($id) {
        $data = Status::find($id);
        $data->delete();
        return redirect('statusList');
    }
    function editstatus($id){
        $data=Status::find($id);
        return view('statusEdit',['data'=>$data]);
    }
    function updatestatus(Request $req){
        $data=Status::find($req->id);
        $data->status=$req->status;
        $data->save();
        return redirect('statusList');
    }

}
