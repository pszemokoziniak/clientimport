<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client_branza;

use App\Http\Requests\BranzaFormRequest;

class ClientBranzaController extends Controller
{
    function index() {
        return view('ClientBranzaAdd');
    }

    function add(BranzaFormRequest $req){
        $source = new Client_branza;
        $source->branza=$req->branza;
        $source->save();
        return redirect('ClientBranzaList');
    }

    function list() {
        $data = Client_branza::all();
        return view('ClientBranzaList',["data"=>$data]);
    }
    function delete($id) {
        $data = Client_branza::find($id);
        $data->delete();
        return redirect('ClientBranzaList');
    }
    function edit($id){
        $data=Client_branza::find($id);
        return view('ClientBranzaEdit',['data'=>$data]);
    }
    function update(BranzaFormRequest $req){
        $data=Client_branza::find($req->id);
        $data->branza=$req->branza;
        $data->save();
        return redirect('ClientBranzaList');
    }

}
