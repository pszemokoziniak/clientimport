<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OfertaFormRequest;

use Auth;

use App\Models\Kalkulator;
use App\Models\Cennik;
use App\Models\Client;
use App\Models\Oferta;
use App\Models\Foto_oferta_email;

use App\Mail\OfertaMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;

class OfertaController extends Controller
{
    function clientList($id) {

        $client = Client::find($id);

        $kalkulator = Kalkulator::where('id_client', $id)
        ->orderBy('created_at', 'DESC')
        ->first();

        $mocKalkulator = $kalkulator->moc;
        $mocKalkulatorStart = $mocKalkulator - 0.1;
        $mocKalkulatorEnd = $mocKalkulator + 0.4;

        $dach = $kalkulator->dach;
        
        ($dach===1) ? $dachNazwa = "plaski" : "";
        ($dach===2) ? $dachNazwa = "skosny" : "";
        ($dach===3) ? $dachNazwa = "grunt" : "";

        ($dach===1) ? $dachNazwaPol = "Płaski" : "";
        ($dach===2) ? $dachNazwaPol = "Skośny" : "";
        ($dach===3) ? $dachNazwaPol = "Grunt" : "";

        
        $ofertaTest = Cennik::select('ilModulow','firma','moc',$dachNazwa.' AS dach')
        ->where('moc','>=', $mocKalkulatorStart)
        ->where('moc','<=', $mocKalkulatorEnd)
        ->get();

        $oferta = DB::table('cenniks')
        ->select('ilModulow','firma','moc','name',$dachNazwa.' AS dach')
        ->join('solarnames', 'cenniks.firma','solarnames.id')
        ->where('moc','>=', $mocKalkulatorStart)
        ->where('moc','<=', $mocKalkulatorEnd)
        ->orderBy('dach', 'ASC')
        ->get();



        return  view('oferta', compact('client','oferta','dachNazwa','mocKalkulatorStart','mocKalkulatorEnd','kalkulator','dachNazwaPol'));
    }

    function store(OfertaFormRequest $req) {
        $data = new Oferta;
        $data->id_client=$req->id_client;
        $data->iloscModulow=$req->iloscModulow;
        $data->firma= $req->firma;
        $data->moc=$req->moc;
        $data->dach=$req->dach;
        $data->cenaNetto=$req->cenaNetto;
        $data->vat=$req->vat;
        $data->cenaBrutto=$req->cenaBrutto;
        $data->email=$req->email;
        $data->user=Auth::user()->id;

        $data->save();



        Mail:: to($req->email)->send(new OfertaMail($data));


        // $data->id;
        Session::flash('sendMail', 'Email Wysłany');

        return redirect('/klient/'.$req->id_client.'?page=foto');

    }

    function fotoOfertaMail($id) {

        $emailData = Oferta::join('clients', 'clients.id', '=', 'ofertas.id_client')
        ->where('ofertas.id', '=', $id)
        ->select('ofertas.id', 'ofertas.iloscModulow', 'ofertas.firma', 'ofertas.dach', 'ofertas.moc', 'ofertas.cenaNetto', 'ofertas.vat', 'ofertas.cenaBrutto', 'ofertas.email', 'ofertas.id_client', 'clients.nazwa', 'clients.miejscowosc')
        ->get();

        foreach ($emailData as $item) {
            Mail:: to($item->email)->send(new OfertaMail($emailData));
        }
        
        $fotoOfertaEmail = new Foto_oferta_email;
        $fotoOfertaEmail->id_foto_oferta = $item->id;
        $fotoOfertaEmail->wyslane = 1;
        $fotoOfertaEmail->user = Auth::user()->id;
        $fotoOfertaEmail->save();
        
        Session::flash('sendMail', 'Email Wysłany');

        return redirect('/klient/'.$item->id_client.'?page=foto');

    }

}
