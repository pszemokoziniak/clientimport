<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    function index() {
        return view('addstatus');
    }

    function addStatus(Request $req){
        $status = new Status;
        $status->status=$req->status;
        $status->save();
        return redirect("liststatus");
    }

    function list() {
        $data = Status::all();
        return view('liststatus',["data"=>$data]);
    }
    function delete($id) {
        $data = Status::find($id);
        $data->delete();
        return redirect('liststatus');
    }
    function editstatus($id){
        $data=Status::find($id);
        return view('editstatus',['data'=>$data]);
    }
    function updatestatus(Request $req){
        $data=Status::find($req->id);
        $data->status=$req->status;
        $data->save();
        return redirect('liststatus');
    }

}
