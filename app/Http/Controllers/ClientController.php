<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Status;
use App\Models\Comment;
use App\Models\Call;
use App\Models\Meeting;
use App\Models\User;



use Illuminate\Http\Request;
use App\Imports\ClientImport;
use Excel;
use Illuminate\Support\Facades\DB;
use App\Exports\ClientExport;
use Auth;



class ClientController extends Controller
{
    public function importForm() 
    {
        return view('import-form');
    }

    public function import(Request $request) 
    {
        Excel::import(new ClientImport, $request->file);
        return redirect("/");
    }

    function list() {

        $data = DB::select('
        SELECT clients.*, statuses.status AS nameStatus, (SELECT count(id_client) from calls
        WHERE clients.id = calls.id_client) AS countCalls
        FROM `clients`
        LEFT JOIN calls ON clients.id = calls.id_client
        LEFT JOIN statuses ON clients.status = statuses.id
        WHERE clients.status = 1 AND clients.handlowiec = \''.Auth::id().'\'
        GROUP BY clients.id, clients.nip_pesel, clients.nazwa, clients.adresmiasto, clients.kodpocztowy, clients.miejscowosc, clients.nrtelefonu, 
        clients.handlowiec, statuses.status, clients.kontakt_data,clients.clients.status,clients.clients.created_at,clients.clients.updated_at,clients.clients.nieObiera
        ORDER BY clients.kontakt_data ASC
        ');
        $data = json_decode(json_encode($data),true);
        return view('clientList',["data"=>$data]);
    }

    function listOutstanding() {
        // $data = Client::all();
        // $data = DB::table('clients')
        // ->select('clients.*','statuses.status')
        // ->join('statuses','clients.status AS nameStatus','statuses.id')
        // ->where('clients.status','2')
        // ->orwhere('clients.status','5')
        // ->orwhere('clients.status','6')
        // ->orderBy('kontakt_data','ASC')
        // ->get();
        $data = DB::select('
        SELECT clients.*, statuses.status AS nameStatus, (SELECT count(id_client) from calls
        WHERE clients.id = calls.id_client) AS countCalls
        FROM `clients`
        LEFT JOIN calls ON clients.id = calls.id_client
        LEFT JOIN statuses ON clients.status = statuses.id
        WHERE (clients.status = 2 OR clients.status = 5 OR clients.status = 6) AND clients.handlowiec = \''.Auth::id().'\'
        GROUP BY clients.id, clients.nip_pesel, clients.nazwa, clients.adresmiasto, clients.kodpocztowy, clients.miejscowosc, clients.nrtelefonu, 
        clients.handlowiec, statuses.status, clients.kontakt_data,clients.clients.status,clients.clients.created_at,clients.clients.updated_at,clients.clients.nieObiera
        ORDER BY clients.kontakt_data ASC
        ');
        $data = json_decode(json_encode($data),true);

        return view('clientListActive',["data"=>$data]);
    }

    function editData($id) {
        $data = Client::find($id);
        $statuses = Status::all();

        $comments = DB::table('comments')
        ->select('comments.*')
        ->where('comments.id_client', $id)
        ->get();

        $count = Call::where('id_client', $id)->get();
        $count = $count->count();

        $meetCount = Meeting::where('id_client', $id)->get();
        $meetCount = $meetCount->count();


        $lasts = DB::table('calls')
        ->select('calls.id_client', 'calls.created_at')
        ->where('calls.id_client', $id)
        ->orderBy('calls.created_at', 'desc')
        ->latest()
        ->get();

        $users = User::query()->get();


        return view('clientEdit', compact('data','statuses','comments', 'count', 'lasts', 'meetCount', 'users'));
    }


    function update(Request $req) {

        // $req->validate([
        //     'adresmiasto'=>'require',
        //     'nrtelefonu'=>'require'
        // ]);

        $data = Client::find($req->id);
        $data->adresmiasto=$req->adresmiasto;
        $data->kodpocztowy=$req->kodpocztowy;
        $data->miejscowosc=$req->miejscowosc;
        $data->nrtelefonu=$req->nrtelefonu;
        $data->status=$req->status;
        $data->handlowiec=$req->handlowiec;
        $data->kontakt_data=$req->kontakt_data;
        $data->nieObiera='0';
        $data->save();
        
        if ($req->comment) {
            $comment = new Comment;
            $comment->id_client = $req->id;
            $comment->comment = $req->comment;
            $comment->save();
        }

        $call = new Call;
        $call->id_client = $req->id;
        $call->id_user = $req->handlowiec;

        $call->save();

        if (session()->get('massage')=='klienciAktywni') {
            return redirect('/klienciAktywni');
        } else {
            return redirect('/');    
        }
    }

    function exportIntoExcel(Request $req){
        return Excel::download(new ClientExport($req->start_data,$req->end_data), 'Kontakty_Przemyslaw_Kozinski.xlsx');
        // return redirect('/');
    }

    function nieOdbiera($id) {
        $data = Client::find($id);
        $data->nieObiera='1';
        $data->save();

        $call = new Call;
        $call->id_client=$id;
        $call->id_user = $data->handlowiec;
        $call->save();

        if ($data->status===1 ) {
            return redirect('/');
        } else {
            return redirect('/klienciAktywni');    
        }
    }

}