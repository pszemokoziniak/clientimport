<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Status;
use App\Models\Comment;
use App\Models\Call;
use App\Models\Meeting;


use Illuminate\Http\Request;
use App\Imports\ClientImport;
use Excel;
use Illuminate\Support\Facades\DB;
use App\Exports\ClientExport;


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
        // $data = Client::all();
        // $data = DB::table('clients')
        // ->select('clients.*','statuses.status', DB::raw('count(calls.id_client) AS count'))
        // ->join('statuses','clients.status','statuses.id')
        // ->leftJoin('calls', 'clients.id', '=', 'calls.id_client')
        // ->where('clients.status','1')
        // ->groupBy('clients.clients.id','clients.clients.nip_pesel','clients.clients.nazwa','clients.clients.adresmiasto',
        // 'clients.clients.kodpocztowy','clients.clients.miejscowosc','clients.clients.nrtelefonu',
        // 'clients.clients.handlowiec','clients.clients.status','clients.clients.kontakt_data','clients.clients.created_at',
        // 'clients.clients.created_at','clients.clients.updated_at','clients.clients.nieObiera','clients.statuses.status')
        // ->get();

        $data = DB::select('
        SELECT clients.*, statuses.status AS nameStatus, (SELECT count(id_client) from calls
        WHERE clients.id = calls.id_client) AS countCalls
        FROM `clients`
        LEFT JOIN calls ON clients.id = calls.id_client
        LEFT JOIN statuses ON clients.status = statuses.id
        WHERE clients.status = 1
        GROUP BY clients.id, clients.nip_pesel, clients.nazwa, clients.adresmiasto, clients.kodpocztowy, clients.miejscowosc, clients.nrtelefonu, 
        clients.handlowiec, statuses.status, clients.kontakt_data,clients.clients.status,clients.clients.created_at,clients.clients.updated_at,clients.clients.nieObiera
        ORDER BY clients.kontakt_data ASC
        ');
        $data = json_decode(json_encode($data),true);
        // $data = collect($data);
        // dd($data);
        // die();
        return view('listclient',["data"=>$data]);
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
        WHERE clients.status = 2 OR clients.status = 5 OR clients.status = 6
        GROUP BY clients.id, clients.nip_pesel, clients.nazwa, clients.adresmiasto, clients.kodpocztowy, clients.miejscowosc, clients.nrtelefonu, 
        clients.handlowiec, statuses.status, clients.kontakt_data,clients.clients.status,clients.clients.created_at,clients.clients.updated_at,clients.clients.nieObiera
        ORDER BY clients.kontakt_data ASC
        ');
        $data = json_decode(json_encode($data),true);

        return view('listclientactive',["data"=>$data]);
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

        return view('editclient', compact('data','statuses','comments', 'count', 'lasts', 'meetCount'));
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
        $data->handlowiec=$req->handlowiec;
        $data->status=$req->status;
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
        $call->save();

        if (session()->get('massage')=='listactive') {
            return redirect('/listactive');
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
        $call->save();

        if ($data->status===1 ) {
            return redirect('/');
        } else {
            return redirect('/listactive');    
        }
    }

    // function addCalls($id) 
}