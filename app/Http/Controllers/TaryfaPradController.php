<?php

namespace App\Http\Controllers;

use App\Models\Pradtaryfa; 
use App\Http\Requests\TaryfaPradFormRequest;

use Illuminate\Http\Request;

class TaryfaPradController extends Controller
{
    function index() {
        return view('taryfaPradAdd');
    }

    function add(TaryfaPradFormRequest $req){
        $source = new Pradtaryfa;
        $source->taryfa=$req->taryfa;
        $source->save();
        return redirect('taryfaPradList');
    }

    function list() {
        $data = Pradtaryfa::all();
        return view('taryfaPradList',["data"=>$data]);
    }
    function delete($id) {
        $data = Pradtaryfa::find($id);
        $data->delete();
        return redirect('taryfaPradList');
    }
    function edit($id){
        $data=Pradtaryfa::find($id);
        return view('taryfaPradEdit',['data'=>$data]);
    }
    function update(TaryfaPradFormRequest $req){
        $data=Pradtaryfa::find($req->id);
        $data->taryfa=$req->taryfa;
        $data->save();
        return redirect('taryfaPradList');
    }

}
