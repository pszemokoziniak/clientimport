<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Meeting;
use App\Models\CommentSpotkania;
use App\Models\Client;

use Illuminate\Support\Facades\Session;

class MeetingController extends Controller
{
    function form($id) {
        return view('meetForm', compact('id'));
    }

    function userId($id_client) {
        $userId = Client::where('id', $id_client)->first();
        $userId = $userId->handlowiec;
        return $userId;
    }


    function insert(Request $req) {
        $data = new Meeting;
        $data->id_client=$req->id_client;
        $data->id_user=$this->userId($req->id_client);
        $data->meet_date=$req->dataspotkania;
        $data->size_instalation=$req->wielkoscinstalacji;
        $data->direct_world=$req->kierunekswiata;
        $data->type_agreement=$req->typumowy;
        $data->type_installation=$req->typinstalacji;
        $data->price_instalation=$req->cena;
        $data->chance_instalation=$req->szansa;

        $data->save();

        if ($req->commentSpotkanie) {
            $comment = new Commentspotkania;
            $comment->id_client = $req->id_client;
            $comment->commet = $req->commentSpotkanie;

            $comment->save();
        }
        
        Session::flash('saveform', 'Zapisano');

        return redirect('/klient/'.$req->id_client);    

    }

    function edit($id_client) {
        $meeting = Meeting::where('id_client', $id_client)->first();
        $commets = Commentspotkania::where('id_client', $id_client)->get();
        $client = Client::where('id', $id_client)->first();
        return view('meetEdit', compact('id_client', 'meeting', 'commets', 'client'));
    }

    function update(Request $req) {

        $data = Meeting::find($req->id_meet);
        $data->id_user=$req->id_user;
        $data->meet_date=$req->dataspotkania;
        $data->size_instalation=$req->wielkoscinstalacji;
        $data->direct_world=$req->kierunekswiata;
        $data->type_agreement=$req->typumowy;
        $data->type_installation=$req->typinstalacji;
        $data->price_instalation=$req->cena;
        $data->chance_instalation=$req->szansa;
        $data->save();
        
        if ($req->commentSpotkanie) {
            $comment = new Commentspotkania;
            $comment->id_client = $req->id_client;
            $comment->commet = $req->commentSpotkanie;
            $comment->save();
        }

        return redirect('/spotkanie/edit/'.$req->id_client);

    }


}
