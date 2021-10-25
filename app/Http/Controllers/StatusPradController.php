<?php

namespace App\Http\Controllers;
use App\Models\Prad_status;
use App\Models\Client;
use App\Models\Log_user;
use App\Models\Prad_comment;
use App\Models\User;

use Illuminate\Support\Facades\Session;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StatusOfertaPradRequest;

class StatusPradController extends Controller
{
    function index() {
        return view('statusOfertaPradAdd');
    }

    function add(StatusOfertaPradRequest $req){
        $source = new Prad_status;
        $source->statusPrad=$req->statusoferta;
        $source->aktywny=$req->aktywny;
        $source->user=Auth::id();

        $log = new Log_user;
        $log->id_client = $req->id_client;;
        $log->akcja = 'Edit - Dodano status prąd Ref: '.$req->id_client;
        $log->user = Auth::id(); 
        $log->save();       

        $source->save();
        return redirect('statusOfertaPradList');
    }

    function list() {
        $data = Prad_status::all();
        return view('statusOfertaPradList',["data"=>$data]);
    }
    function delete($id) {
        $data = Prad_status::find($id);
        $data->delete();

        $log = new Log_user;
        $log->id_client = $req->id_client;;
        $log->akcja = 'Edit - Wykasowano status prąd Ref: '.$req->id_client;
        $log->user = Auth::id(); 
        $log->save();       


        return redirect('statusOfertaPradList');
    }
    function edit($id){
        $data=Prad_status::find($id);
        return view('statusOfertaPradEdit',['data'=>$data]);
    }
    function update(StatusOfertaPradRequest $req){
        $data=Prad_status::find($req->id);
        $data->statusPrad=$req->statusoferta;
        $data->aktywny=$req->aktywny;
        $data->save();

        $log = new Log_user;
        $log->id_client = $req->id_client;;
        $log->akcja = 'Edit - Zmiana status prąd Ref: '.$req->id;
        $log->user = Auth::id(); 
        $log->save();       


        return redirect('statusOfertaPradList');
    }

    function updateStatus(Request $req) {
        $data = Client::find($req->id);
        $data->statusPrad=$req->status;

        if ($req->commentPrad) {
            $comment = new Prad_comment;
            $comment->id_client = $data->id;
            $comment->comment = $req->commentPrad;
            $comment->user = auth()->user()->id;
            $comment->save();
        }

        $saveed = $data->save();

        $log = new Log_user;
        $log->id_client = $req->id_client;;
        $log->akcja = 'Zmiana statusu prąd Ref: '.$data->id;
        $log->user = Auth::id(); 
        $log->save();       


        if ($saveed) {
            Session::flash('saveform', 'Zapisano');
        
        return redirect('klient/'.$req->id.'?page=prad');
        }
    }

    function ajaxStatus(Request $req) {

        $log = new Log_user;
        $log->id_client = $req->id;
        $log->akcja = 'Zmiana statusu prąd Ref: '.$req->id;
        $log->user = Auth::id(); 
        $log->save();

    
        $coment = new Prad_comment;
        $coment->id_client = $req->id;
        $coment->comment = $req->comment;
        $coment->user = Auth::id(); 
        $coment->save();

        $user = User::find($coment->user);
        $user->get();


        $data = Client::find($req->id);
        $data->statusPrad=$req->status;
        $data->save();

        // $arr = array('comment'=>$req->comment);

        if($data){
            #Display Success Message in Blade File
                $arr = array('msg' => 'Zapisano!', 'status' => true, 'comment'=>$req->comment, 
                'date'=>date_format($coment->created_at,"Y/m/d H:i:s"), 'user'=>$user->name);
            } else {
                $arr = array('msg' => 'Nie zapisano!', 'status' => false, 'comment'=>$req->comment,
                 'date'=>date_format($coment->created_at,"Y/m/d H:i:s"), 'user'=>$user->name);
            }

            return Response()->json($arr);

    }
    
}
