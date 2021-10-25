<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use DB;

use Illuminate\Http\Request;

class FtpController extends Controller
{
    function store(Request $request) {

        if($request->hasFile('profile_image')) {

            // $id_client = $request->id_client;
            // $id_umowa = $request->id_umowa;
         
            //get filename with extension
            $filenamewithextension = $request->file('profile_image')->getClientOriginalName();
    
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            //Upload File to external server
            $storage = Storage::disk('ftp')->put($filenametostore, fopen($request->file('profile_image'), 'r+'));
            if ($storage) {
            }
            //Store $filenametostore in the database
        }
 
    return redirect('log')->with('status', "Image uploaded successfully.");
    }

    function form($id) {


        $data = DB::table('prad_back_umowas')
        ->select('prad_back_umowas.*', 'praddystrybucjas.dystrybucja', 'pradtaryfas.taryfa', 'dostawcaprads.firmadostawca', 'clients.nazwa')
        ->join('dostawcaprads', 'prad_back_umowas.firmadostawca', '=', 'dostawcaprads.id')
        ->join('pradtaryfas', 'prad_back_umowas.taryfa', '=', 'pradtaryfas.id')
        ->join('praddystrybucjas', 'prad_back_umowas.terendystrybucja', '=', 'praddystrybucjas.id')
        ->join('clients', 'prad_back_umowas.id_client', '=', 'clients.id')

        ->where('prad_back_umowas.id', '=', $id)

          ->get();

        return view('ftpback', compact('data'));
    }
}
