<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationaMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use App\Models\Email_token;

class MailRegistrationController extends Controller
{
    function RegistrationMail(Request $req) {
        $email = $req->email;
        $token = (Hash::make($email));
        $token = preg_replace("/[^a-zA-Z0-9]+/", "", $token);
        $token = substr($token,0,15);
        $data = new Email_token;
        $data->token=$token;
        $data->save();

        Mail:: to($email)->send(new RegistrationaMail($email, $token));
        // Session::flash('sendMail', 'Email Wysłany');
        return response()->json(['name' => 'Abigail', 'state' => 'CA']); 
        // return 'test';

        

    //     function fotoOfertaMail($id) {

    //     $emailData = Oferta::join('clients', 'clients.id', '=', 'ofertas.id_client')
    //     ->where('ofertas.id', '=', $id)
    //     ->select('ofertas.id', 'ofertas.iloscModulow', 'ofertas.firma', 'ofertas.dach', 'ofertas.moc', 'ofertas.cenaNetto', 'ofertas.vat', 'ofertas.cenaBrutto', 'ofertas.email', 'ofertas.id_client', 'clients.nazwa', 'clients.miejscowosc')
    //     ->get();

    //     foreach ($emailData as $item) {
    //         Mail:: to($item->email)->send(new OfertaMail($emailData));
    //     }
        
    //     $fotoOfertaEmail = new Foto_oferta_email;
    //     $fotoOfertaEmail->id_foto_oferta = $item->id;
    //     $fotoOfertaEmail->wyslane = 1;
    //     $fotoOfertaEmail->user = Auth::user()->id;
    //     $fotoOfertaEmail->save();
        
    //     Session::flash('sendMail', 'Email Wysłany');

    //     return redirect('/klient/'.$item->id_client.'?page=foto');

    // }
        
    //     $fotoOfertaEmail = new Foto_oferta_email;
    //     $fotoOfertaEmail->id_foto_oferta = $item->id;
    //     $fotoOfertaEmail->wyslane = 1;
    //     $fotoOfertaEmail->user = Auth::user()->id;
    //     $fotoOfertaEmail->save();
        
    //     Session::flash('sendMail', 'Email Wysłany');

    //     return redirect('/klient/'.$item->id_client.'?page=foto');

    }
}
