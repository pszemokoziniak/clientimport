<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Status;
use App\Models\Comment;


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
        $data = DB::table('clients')
        ->select('clients.*','statuses.status')
        ->join('statuses','clients.status','statuses.id')
        ->get();

        return view('listclient',["data"=>$data]);
    }

    function editData($id) {
        $data = Client::find($id);
        $statuses = Status::all();

        $comments = DB::table('comments')
        ->select('comments.*')
        ->where('comments.id_client', $id)
        ->get();


        return view('editclient', compact('data','statuses','comments'));
    }

    function update(Request $req) {

        // $req->validate([
        //     'adresmiasto'=>'require',
        //     'nrtelefonu'=>'require'
        // ]);

        $data = Client::find($req->id);
        $data->adresmiasto=$req->adresmiasto;
        $data->kodpocztowy=$req->kodpocztowy;
        $data->nrtelefonu=$req->nrtelefonu;
        $data->handlowiec=$req->handlowiec;
        $data->status=$req->status;
        $data->kontakt_data=$req->kontakt_data;
        $data->save();
        
        if ($req->comment) {
            $comment = new Comment;
            $comment->id_client = $req->id;
            $comment->comment = $req->comment;
            $comment->save();
        }
        return redirect('/');
    }

    function exportIntoExcel(Request $req){
        return Excel::download(new ClientExport($req->start_data,$req->end_data), 'clientlist.xlsx');
        // return redirect('/');
    }
}