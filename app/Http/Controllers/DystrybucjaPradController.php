<?php

namespace App\Http\Controllers;

use App\Models\Praddystrybucja;

use Illuminate\Http\Request;
use App\Http\Requests\DystrybucjaPradRequest;

class DystrybucjaPradController extends Controller
{
    function index() {
        return view('dystrybucjaPradAdd');
    }

    function add(DystrybucjaPradRequest $req){
        $source = new Praddystrybucja;
        $source->dystrybucja=$req->dystrybucja;
        $source->save();
        return redirect('dystrybucjaPradList');
    }

    function list() {
        $data = Praddystrybucja::all();
        return view('dystrybucjaPradList',["data"=>$data]);
    }
    function delete($id) {
        $data = Praddystrybucja::find($id);
        $data->delete();
        return redirect('dystrybucjaPradList');
    }
    function edit($id){
        $data=Praddystrybucja::find($id);
        return view('dystrybucjaPradEdit',['data'=>$data]);
    }
    function update(DystrybucjaPradRequest $req){
        $data=Praddystrybucja::find($req->id);
        $data->dystrybucja=$req->dystrybucja;
        $data->save();
        return redirect('dystrybucjaPradList');
    }
}
