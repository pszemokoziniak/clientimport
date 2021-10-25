<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rozmowy_Status;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\StatusFormRequest;


class StatusController extends Controller
{
    function index() {
        return view('statusAdd');
    }

    function addStatus(StatusFormRequest $req){
        $status = new Rozmowy_Status;
        $status->status=$req->status;
        $status->aktywny=$req->aktywny;
        $status->save();
        return redirect("statusList");
    }

    function list() {
        $data = Rozmowy_Status::all();
        return view('statusList',["data"=>$data]);
    }
    function delete($id) {
        $data = Rozmowy_Status::find($id);
        $data->delete();
        return redirect('statusList');
    }
    function editstatus($id){
        $data=Rozmowy_Status::find($id);
        return view('statusEdit',['data'=>$data]);
    }
    function updatestatus(Request $req){
        $data=Rozmowy_Status::find($req->id);
        $data->status=$req->status;
        $data->aktywny=$req->aktywny;
        $data->save();
        return redirect('statusList');
    }

}
