<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Meeting;


class MeetingController extends Controller
{
    function form($id) {
        // $data = Meeting::find($id);
        // return view('formmeet', ["data"=>$data]);
        return view('formmeet', ["id"=>$id]);
    }
    function insert(Request $req) {
        $data = new Meeting;
        $data->id_client=$req->id_client;
        $data->meet_date=$req->dataspotkania;
        $data->size_instalation=$req->wielkoscinstalacji;
        $data->direct_world=$req->kierunekswiata;
        $data->type_agreement=$req->typumowy;
        $data->type_installation=$req->typinstalacji;
        $data->price_instalation=$req->cena;
        $data->chance_instalation=$req->szansa;
        $data->meet_description=$req->commentSpotkanie;

        $data->save();

        return redirect('/editclient/'.$req->id_client);    

    }

}
