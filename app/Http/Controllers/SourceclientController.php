<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sourceclient;


class SourceclientController extends Controller
{
    function index() {
        return view('sourceAdd');
    }

    function add(Request $req){
        $source = new Sourceclient;
        $source->source=$req->source;
        $source->save();
        return redirect("sourceList");
    }

    function list() {
        $data = Sourceclient::all();
        return view('sourceList',["data"=>$data]);
    }
    function delete($id) {
        $data = Sourceclient::find($id);
        $data->delete();
        return redirect('sourceList');
    }
    function edit($id){
        $data=Sourceclient::find($id);
        return view('sourceEdit',['data'=>$data]);
    }
    function update(Request $req){
        $data=Sourceclient::find($req->id);
        $data->source=$req->source;
        $data->save();
        return redirect('sourceList');
    }
}
