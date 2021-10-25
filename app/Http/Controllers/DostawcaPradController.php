<?php

namespace App\Http\Controllers;

use App\Models\Dostawcaprad;

use Illuminate\Http\Request; 
use App\Http\Requests\DostawcaPradFormRequest;

class DostawcaPradController extends Controller
{
    function index() {
        return view('dostawcaPradAdd');
    }

    function add(DostawcaPradFormRequest $req){
        $source = new Dostawcaprad;
        $source->firmadostawca=$req->firmadostawca;
        $source->save();
        return redirect('dostawcaPradList');
    }

    function list() {
        $data = Dostawcaprad::all();
        return view('dostawcaPradList',["data"=>$data]);
    }
    function delete($id) {
        $data = Dostawcaprad::find($id);
        $data->delete();
        return redirect('dostawcaPradList');
    }
    function edit($id){
        $data=Dostawcaprad::find($id);
        return view('dostawcaPradEdit',['data'=>$data]);
    }
    function update(DostawcaPradFormRequest $req){
        $data=Dostawcaprad::find($req->id);
        $data->firmadostawca=$req->firmadostawca;
        $data->save();
        return redirect('dostawcaPradList');
    }
}
