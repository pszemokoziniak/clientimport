<?php

namespace App\Http\Controllers;

use App\Models\Kalkulator;

use Illuminate\Http\Request;
use App\Http\Requests\KalulatorFormRequest;

use Illuminate\Support\Facades\Session;



class KalkulatorController extends Controller
{
    function kalkulator() {
        return view('kalkulatorForm');
    }

    function insert(KalulatorFormRequest $req) {
        
        $data = new Kalkulator;
        $data->id_client=$req->id_client;
        $data->rachunek=$req->rachunek;
        $data->cykl= $req->cykl;
        $data->zuzycie=$req->zuzycie;
        $data->dach=$req->dach;
        $data->zuzycieroczne=$req->zuzycieroczne;
        $data->moc=$req->moc;
        $data->oszczednosc=$req->oszczednosc;
        $data->mocmodulow=$req->mocmodulow;
        $data->iloscmodulow=$req->iloscmodulow;
        $data->minpowskosny=$req->minpowskosny;
        $data->minpowgrunt=$req->minpowgrunt;

        $data->save();
        // $data->id;
        // Session::flash('saveform', 'Zapisano');

        return redirect('/oferta/'.$req->id_client);  
    }
}
