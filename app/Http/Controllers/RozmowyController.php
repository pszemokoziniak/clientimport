<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Rozmowy_comment;
use App\Models\Call;
use App\Models\Meeting;
// use App\Models\User;

use Auth;

use App\Http\Requests\ShareFormRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;


class RozmowyController extends Controller
{
    function update(Request $req) {

        $data = Client::find($req->id);
        $data->status=$req->status;
        $data->kontakt_data=$req->kontakt_data;
        $data->nieObiera='0';
        $data->kontakt_godzina=$req->kontakt_godzina;
        $save = $data->save();
        
        if ($req->comment) {
            $comment = new Rozmowy_comment;
            $comment->id_client = $req->id;
            $comment->comment = $req->comment;
            $comment->save();
        }

        $user = Auth::user();

        $call = new Call;
        $call->id_client = $req->id;
        $call->id_user = $user->id;
        $call->save();

        if($save) {
            Session::flash('saveform', 'Zapisano');
            return redirect('/klient/'.$req->id.'?page=rozmowy');
        }    
    }

}
