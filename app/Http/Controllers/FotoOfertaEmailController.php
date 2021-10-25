<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Foto_oferta_email;


class FotoOfertaEmailController extends Controller
{
    public static function email_status($id_oferta){
        // $oferta = Foto_oferta_email::find($id_oferta);

        $email = '';
        $foto_oferta_email = Foto_oferta_email::join('users', 'users.id', '=', 'foto_oferta_emails.user')
        ->where('id_foto_oferta', $id_oferta)
        ->get(['foto_oferta_emails.created_at', 'users.name']);

        // dd($foto_oferta_email);
        // exit;

        // foreach ($foto_oferta_email as $item) {
        //     $email .= $item->created_at .' '.$item->name.'<br />'; 
        // }

        return $foto_oferta_email;

    }
}
