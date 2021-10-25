<?php

namespace App\Http\Controllers;
use App\Http\Requests\PradFormRequest;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


use App\Models\Rozmowy_status;
use App\Models\User;
use App\Models\Sourceclient;
use App\Models\Client; 
use App\Models\Dostawcaprad;
use App\Models\Pradtaryfa;
use App\Models\Praddystrybucja;
use App\Models\Client_kampania;
use App\Models\Prad_status;
use App\Models\Prad_oferta;
use App\Models\Pradcomment;
use App\Models\Prad_faktura;
use App\Models\Prad_comment;
use App\Models\Prad_faktura_comment;
use App\Models\Log_user;
use App\Models\Prad_back_umowa;
use App\Models\Prad_back_comment;



use Auth;

use Illuminate\Http\Request;

class PradController extends Controller
{
    function form($id) {

        $data = Client::find($id);

        $statuses = Rozmowy_status::all();
        $users = User::all();
        $sourceclients = Sourceclient::all();
        $dostawcaprad = Dostawcaprad::all();
        $pradtaryfa = Pradtaryfa::all();
        $praddystrybucja = Praddystrybucja::all();
        $pradkampania = Client_kampania::all();
        $pradstatusoferta = Prad_status::all();


        return view('pradOfertaForm', compact('data', 'statuses', 'users', 'sourceclients', 'dostawcaprad', 'pradtaryfa', 'praddystrybucja', 'pradkampania', 'pradstatusoferta'));
    }

    function insert(PradFormRequest $req) {

        // $today = new DateTime('NOW');
        // $today = $today->format('Y-m-d');

        $data = new Prad_oferta;
        $data->id_client=$req->id_client;
        $data->firmadostawca=$req->firmadostawca; 
        $data->taryfa=$req->taryfa;
        $data->cennik=$req->cennik;
        // $data->kodpocztowy= !empty($req->kodpocztowy) ?  $req->kodpocztowy : '';
        $data->volumen=$req->volumen;
        $data->ppe=$req->ppe;
        // $data->status=1;
        $data->terendystrybucja=$req->terendystrybucja;
        $data->start=$req->start;
        $data->end=$req->end;
        $data->cenaklient=$req->cenaklient; 
        $data->kampania=$req->kampania;
        $data->status=$req->statusoferta;


        $saved = $data->save();
        // $data->id;
        
        if ($req->comment) {
            $comment = new PradOfertaComment;
            $comment->id_client = $data->id;
            $comment->comment = $req->comment;
            $comment->user = Auth::id();
            $comment->save();
        }

        $log = new Log_user;
        $log->id_client = $req->id_client;;
        $log->akcja = 'Wprowadzenie oferty prąd Ref: '.$data->id;
        $log->user = Auth::id(); 
        $log->save();       


        if($saved) {
            Session::flash('saveform', 'Zapisano');
            return redirect('/klient/'.$req->id_client.'?page=prad');  
        }
    }
    function editOferta($id) {

        $dataprad = Prad_oferta::find($id);
        
        $statuses = Rozmowy_status::all();
        $users = User::all();
        $sourceclients = Sourceclient::all();
        $dostawcaprad = Dostawcaprad::all();
        $pradtaryfa = Pradtaryfa::all();
        $praddystrybucja = Praddystrybucja::all();
        $pradkampania = Client_kampania::all();
        $pradstatusoferta = Prad_status::all();

        $log = new Log_user;
        $log->akcja = 'Wejście oferta prąd Ref: '.$id;
        $log->user = Auth::id(); 
        $log->save();       

        return view('pradOfertaEdit', compact('dataprad', 'statuses', 'users', 'sourceclients', 'dostawcaprad', 'pradtaryfa', 'praddystrybucja', 'pradkampania', 'pradstatusoferta'));

    }

    function updateOferta(PradFormRequest $req) {

        // $today = new DateTime('NOW');
        // $today = $today->format('Y-m-d');
        $data = Prad_oferta::find($req->id);
        $data->id_client=$req->id_client;
        $data->firmadostawca=$req->firmadostawca; 
        $data->taryfa=$req->taryfa;
        $data->cennik=$req->cennik;
        // $data->kodpocztowy= !empty($req->kodpocztowy) ?  $req->kodpocztowy : '';
        $data->volumen=$req->volumen;
        $data->ppe=$req->ppe;
        // $data->status=1;
        $data->terendystrybucja=$req->terendystrybucja;
        $data->start=$req->start;
        $data->end=$req->end;
        $data->cenaklient=$req->cenaklient; 

        $data->kampania=$req->kampania;
        $data->status=$req->statusoferta;


        $saved = $data->save();
        // $data->id;
        
        $log = new Log_user;
        $log->id_client = $req->id_client;;
        $log->akcja = 'Zmiana oferta prąd Ref: '.$data->id;
        $log->user = Auth::id(); 
        $log->save();       


        if($saved) {
            Session::flash('saveform', 'Zapisano');
            return redirect('/klient/'.$req->id_client.'?page=prad');  
        }
    }
    function archOferta($id) {
        // $today = new DateTime('NOW');
        // $today = $today->format('Y-m-d');
        $data = Prad_oferta::find($id);
        $data->archiwum = '1';

        $saved = $data->save();

        $id_client = $data->id_client;

        $log = new Log_user;
        $log->id_client = $id_client;
        $log->akcja = 'Archiwizacja oferta prąd Ref: '.$id;
        $log->user = Auth::id(); 
        $log->save();     


        if($saved) {
            Session::flash('saveform', 'Zapisano');
            return redirect('/klient/'.$id_client.'?page=prad');
        }
    }

    function formFaktura($id) {

        $data = Client::find($id);

        $statuses = Rozmowy_status::all();
        $users = User::all();
        $sourceclients = Sourceclient::all();
        $dostawcaprad = Dostawcaprad::all();
        $pradtaryfa = Pradtaryfa::all();
        $praddystrybucja = Praddystrybucja::all();
        $pradkampania = Client_kampania::all();
        $pradstatusoferta = Prad_status::all();


        return view('pradFakturaForm', compact('data', 'statuses', 'users', 'sourceclients', 'dostawcaprad', 'pradtaryfa', 'praddystrybucja', 'pradkampania', 'pradstatusoferta'));
    }

    function insertFaktura(PradFormRequest $req) {

        // $today = new DateTime('NOW');
        // $today = $today->format('Y-m-d');

        $data = new Prad_faktura;
        $data->id_client=$req->id_client;
        $data->firmadostawca=$req->firmadostawca; 
        $data->taryfa=$req->taryfa;
        // $data->cennik=$req->cennik;
        // $data->kodpocztowy= !empty($req->kodpocztowy) ?  $req->kodpocztowy : '';
        $data->volumen=$req->volumen;
        $data->ppe=$req->ppe;
        // $data->status=1;
        $data->terendystrybucja=$req->terendystrybucja;
        $data->start=$req->start;
        $data->end=$req->end;
        $data->cenaklient=$req->cenaklient; 
        $data->user=Auth::id();

        // $data->kampania=$req->kampania;
        // $data->status=$req->statusoferta;


        $saved = $data->save();
        // $data->id;
        
        if ($req->comment) {
            $comment = new Prad_faktura_comment;
            $comment->id_client = $data->id;
            $comment->comment = $req->comment;
            $comment->user = Auth::id();

            $comment->save();
        }

        $log = new Log_user;
        $log->id_client = $req->id_client;;
        $log->akcja = 'Wprowadzenie faktury prąd Ref: '.$data->id;
        $log->user = Auth::id(); 
        $log->save();       

        if($saved) {
            Session::flash('saveform', 'Zapisano');
            return redirect('/klient/'.$req->id_client.'?page=prad');  
        }
    }

    function editFaktura($id) {

        $dataprad = Prad_faktura::find($id);
        
        $statuses = Rozmowy_status::all();
        $users = User::all();
        $sourceclients = Sourceclient::all();
        $dostawcaprad = Dostawcaprad::all();
        $pradtaryfa = Pradtaryfa::all();
        $praddystrybucja = Praddystrybucja::all();
        $pradkampania = Client_kampania::all();
        $pradstatusoferta = Prad_status::all();

        $log = new Log_user;
        $log->akcja = 'Wizyta faktura prąd Ref: '.$id;
        $log->user = Auth::id(); 
        $log->save();       

        return view('pradFakturaEdit', compact('dataprad', 'statuses', 'users', 'sourceclients', 'dostawcaprad', 'pradtaryfa', 'praddystrybucja', 'pradkampania', 'pradstatusoferta'));

    }

    function updateFaktura(PradFormRequest $req) {

        // $today = new DateTime('NOW');
        // $today = $today->format('Y-m-d');
        $data = Prad_faktura::find($req->id);
        $data->id_client=$req->id_client;
        $data->firmadostawca=$req->firmadostawca; 
        $data->taryfa=$req->taryfa;
        // $data->cennik=$req->cennik;
        // $data->kodpocztowy= !empty($req->kodpocztowy) ?  $req->kodpocztowy : '';
        $data->volumen=$req->volumen;
        $data->ppe=$req->ppe;
        // $data->status=1;
        $data->terendystrybucja=$req->terendystrybucja;
        $data->start=$req->start;
        $data->end=$req->end;
        $data->cenaklient=$req->cenaklient; 

        // $data->kampania=$req->kampania;
        // $data->status=$req->statusoferta;


        $saved = $data->save();
        // $data->id;
        
        if ($req->comment) {
            $comment = new Prad_faktura_comment;
            $comment->id_client = $data->id;
            $comment->comment = $req->comment;
            $comment->user = Auth::id();

            $comment->save();
        }

        $log = new Log_user;
        $log->id_client = $req->id_client;;
        $log->akcja = 'Zmiana faktury prąd Ref: '.$data->id;
        $log->user = Auth::id(); 
        $log->save();       


        if($saved) {
            Session::flash('saveform', 'Zapisano');
            return redirect('/klient/'.$req->id_client.'?page=prad');  
        }
    }

    function archFaktura($id) {
        // $today = new DateTime('NOW');
        // $today = $today->format('Y-m-d');
        $data = Prad_faktura::find($id);
        $data->archiwum = '1';

        $saved = $data->save();

        $id_client = $data->id_client;

        $log = new Log_user;
        $log->id_client = $id_client;
        $log->akcja = 'Archiwizacja faktury prąd Ref: '.$id;
        $log->user = Auth::id(); 
        $log->save();     


        if($saved) {
            Session::flash('saveform', 'Zapisano');
            return redirect('/klient/'.$id_client.'?page=prad');
        }
    }

    function formUmowa($id) {

        $data = Client::find($id);

        $statuses = Rozmowy_status::all();
        $users = User::all();
        $sourceclients = Sourceclient::all();
        $dostawcaprad = Dostawcaprad::all();
        $pradtaryfa = Pradtaryfa::all();
        $praddystrybucja = Praddystrybucja::all();
        $pradkampania = Client_kampania::all();
        $pradstatusoferta = Prad_status::all();
        
        $id_client = $id;

        $log = new Log_user;
        $log->id_client = $id_client;
        $log->akcja = 'Wejście formularz Umowa Ref: '.$id;
        $log->user = Auth::id(); 
        $log->save();     


        return view('pradbackform', compact('data', 'statuses', 'users', 'sourceclients', 'dostawcaprad', 'pradtaryfa', 'praddystrybucja', 'pradkampania', 'pradstatusoferta'));
    }

    function insertUmowa(Request $req) {

        // $today = new DateTime('NOW');
        // $today = $today->format('Y-m-d');

        $data = new Prad_back_umowa;
        $data->id_client=$req->id_client;
        $data->firmadostawca=$req->firmadostawca; 
        $data->taryfa=$req->taryfa;
        $data->volumen=$req->volumen;
        $data->ppe=$req->ppe;
        $data->terendystrybucja=$req->terendystrybucja;
        $data->start=$req->start;
        $data->end=$req->end;
        $data->cenaklient=$req->cenaklient; 
        $data->save();

        $id = $data->id;

        $log = new Log_user;
        $log->id_client = $req->id_client;
        $log->akcja = 'Zapisany formularz Umowa Ref: '.$id;
        $log->user = Auth::id(); 
        $log->save();     


        // $data->id;
        
        if ($req->comment) {
            $comment = new Prad_back_comment;
            $comment->id_client = $req->id_client;
            $comment->comment = $req->comment;
            $comment->save();
        }

        if($data->id) {
            Session::flash('saveform', 'Zapisano');
            return redirect('/ftpback/'.$req->id_client.'?page=prad');  
        }
    }
    function editUmowa($id) {

        $dataprad = Prad_back_umowa::find($id);
        
        $statuses = Rozmowy_status::all();
        $users = User::all();
        $sourceclients = Sourceclient::all();
        $dostawcaprad = Dostawcaprad::all();
        $pradtaryfa = Pradtaryfa::all();
        $praddystrybucja = Praddystrybucja::all();
        $pradkampania = Client_kampania::all();
        $pradstatusoferta = Prad_status::all();

        $log = new Log_user;
        $log->akcja = 'Wizyta umowa prąd Ref: '.$id;
        $log->user = Auth::id(); 
        $log->save();       

        return view('pradBackEdit', compact('dataprad', 'statuses', 'users', 'sourceclients', 'dostawcaprad', 'pradtaryfa', 'praddystrybucja', 'pradkampania', 'pradstatusoferta'));

    }

    function updateUmowa(PradFormRequest $req) {

        // $today = new DateTime('NOW');
        // $today = $today->format('Y-m-d');
        $data = Prad_back_umowa::find($req->id);
        $data->id_client=$req->id_client;
        $data->firmadostawca=$req->firmadostawca; 
        $data->taryfa=$req->taryfa;
        // $data->cennik=$req->cennik;
        // $data->kodpocztowy= !empty($req->kodpocztowy) ?  $req->kodpocztowy : '';
        $data->volumen=$req->volumen;
        $data->ppe=$req->ppe;
        // $data->status=1;
        $data->terendystrybucja=$req->terendystrybucja;
        $data->start=$req->start;
        $data->end=$req->end;
        $data->cenaklient=$req->cenaklient; 

        // $data->kampania=$req->kampania;
        // $data->status=$req->statusoferta;


        $saved = $data->save();
        // $data->id;
        
        if ($req->comment) {
            $comment = new Prad_back_comment;
            $comment->id_client = $data->id;
            $comment->comment = $req->comment;
            $comment->user = Auth::id();

            $comment->save();
        }

        $log = new Log_user;
        $log->id_client = $req->id_client;;
        $log->akcja = 'Zmiana umowa prąd Ref: '.$data->id;
        $log->user = Auth::id(); 
        $log->save();       


        if($saved) {
            Session::flash('saveform', 'Zapisano');
            return redirect('/klient/'.$req->id_client.'?page=prad');  
        }
    }

    function archUmowa($id) {
        // $today = new DateTime('NOW');
        // $today = $today->format('Y-m-d');
        $data = Prad_back_umowa::find($id);
        $data->archiwum = '1';

        $saved = $data->save();

        $id_client = $data->id_client;

        $log = new Log_user;
        $log->id_client = $id_client;
        $log->akcja = 'Archiwizacja umowa prąd Ref: '.$id;
        $log->user = Auth::id(); 
        $log->save();     


        if($saved) {
            Session::flash('saveform', 'Zapisano');
            return redirect('/klient/'.$id_client.'?page=prad');
        }
    }    
}
