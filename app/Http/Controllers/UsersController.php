<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    function index() {
        return view('userAdd');
    }

    function add(StatusFormRequest $req){
        $status = new User;
        $status->status=$req->status;
        $status->aktywny=$req->aktywny;
        $status->save();
        return redirect("userList");
    }

    function list() {
        $data = User::all();
        return view('userList',["data"=>$data]);
    }
    function delete($id) {
        $data = User::find($id);
        $data->delete();
        return redirect('userList');
    }
    function edit($id){
        $data=User::find($id);
        return view('userEdit',['data'=>$data]);
    }
    function update(Request $req){
        $data=User::find($req->id);
        $data->status=$req->status;
        $data->aktywny=$req->aktywny;
        $data->save();
        return redirect('userList');
    }
    function UserOffline(Request $request) {
        $data = User::find($request['id']);
        $data->admin_level = $request['on'];
        $data->save();
        // info($request);
        return 'test';
    }

}
