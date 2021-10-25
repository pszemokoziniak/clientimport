<?php

namespace App\Http\Controllers;

use App\Models\Client_kampania;


use Illuminate\Http\Request;
use App\Http\Requests\KampaniaPradRequest;


class KampaniaPradController extends Controller
{
    function index() {
        return view('kampaniaPradAdd');
    }

    function add(KampaniaPradRequest $req){
        $source = new Client_kampania;
        $source->kampania=$req->kampania;
        $source->save();
        return redirect('kampaniaPradList');
    }

    function list() {
        $data = Client_kampania::all();
        return view('kampaniaPradList',["data"=>$data]);
    }
    function delete($id) {
        $data = Client_kampania::find($id);
        $data->delete();
        return redirect('kampaniaPradList');
    }
    function edit($id){
        $data=Client_kampania::find($id);
        return view('kampaniaPradEdit',['data'=>$data]);
    }
    function update(KampaniaPradRequest $req){
        $data=Client_kampania::find($req->id);
        $data->kampania=$req->kampania;
        $data->save();
        return redirect('kampaniaPradList');
    }

}
