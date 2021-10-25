<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\StatusesFoto;
use App\Models\Client;
use App\Models\Commentfoto;

use App\Http\Requests\StatusFormRequest;
use App\Http\Requests\ShareFormRequest;

use Illuminate\Support\Facades\Session;

class StatusFotoController extends Controller
{
    function index() {
        return view('statusesFotoAdd');
    }

    function add(StatusFormRequest $req){
        $source = new StatusesFoto;
        $source->status=$req->status;
        $source->aktywny=$req->aktywny;
        $source->save();
        return redirect('statutesFotoList');
    }

    function list() {
        $data = StatusesFoto::all();
        return view('statusesFotoList',["data"=>$data]);
    }
    function delete($id) {
        $data = StatusesFoto::find($id);
        $data->delete();
        return redirect('statutesFotoList');
    }
    function edit($id){
        $data=StatusesFoto::find($id);
        return view('statusesFotoEdit',['data'=>$data]);
    }
    function update(StatusFormRequest $req){
        $data=StatusesFoto::find($req->id);
        $data->status=$req->status;
        $data->aktywny=$req->aktywny;
        $data->save();
        return redirect('statutesFotoList');
    }
    function updateFoto(StatusFormRequest $req) {
        $data = Client::find($req->id);
        $data->statusFoto=$req->status;

        if ($req->commentFoto) {
            $comment = new Commentfoto;
            $comment->id_client = $data->id;
            $comment->comment = $req->commentFoto;
            $comment->user = auth()->user()->id;
            $comment->save();
        }

        $data->save();

        if ($data) {
            Session::flash('saveform', 'Zapisano');
        }
        return redirect('klient/'.$req->id.'?page=foto');

    }
}
