<?php


namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Rozmowy_status;
use App\Models\Comment;
use App\Models\Call;
use App\Models\Meeting;
use App\Models\User;
use App\Models\Oferta;
use App\Models\Sourceclient;
use App\Models\StatusesFoto;
use App\Models\Commentfoto;
use App\Models\Ofertyprad;
use App\Models\Client_kampania;
use App\Models\Client_branza;
use App\Models\Prad_status;


use Illuminate\Http\Request;
use App\Http\Requests\ShareFormRequest;

use App\Imports\ClientImport;
use Excel;
use Illuminate\Support\Facades\DB;
use App\Exports\ClientExport;
use Auth;
use DateTime;
use Illuminate\Support\Facades\Session;

use SoapClient;

use DateTimeImmutable;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\Exception\NotFoundException;
use GusApi\GusApi;
use GusApi\ReportTypes;
use GusApi\BulkReportTypes;






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
        SELECT clients.*, rozmowy_statuses.status AS nameStatus, (SELECT count(id_client) from calls
        WHERE clients.id = calls.id_client) AS countCalls
        FROM `clients`
        LEFT JOIN calls ON clients.id = calls.id_client
        LEFT JOIN rozmowy_statuses ON clients.status = rozmowy_statuses.id
        WHERE clients.status = 1 AND clients.handlowiec = \''.Auth::id().'\'
        GROUP BY clients.id, clients.nip_pesel, clients.nazwa, clients.adresmiasto, clients.kodpocztowy, clients.miejscowosc, clients.nrtelefonu, 
        clients.handlowiec, rozmowy_statuses.status, clients.kontakt_data,clients.clients.status,clients.clients.created_at,clients.clients.updated_at,clients.clients.nieObiera,clients.clients.email,clients.clients.nip
        ORDER BY clients.kontakt_data ASC
        ');
        $data = json_decode(json_encode($data),true);
        return view('clientList', compact('data'));
    }

    function listOutstanding() {

        $data = DB::select('
        SELECT clients.*, rozmowy_statuses.status AS nameStatus, (SELECT count(id_client) from calls
        WHERE clients.id = calls.id_client) AS countCalls
        FROM `clients`
        LEFT JOIN calls ON clients.id = calls.id_client
        LEFT JOIN rozmowy_statuses ON clients.status = rozmowy_statuses.id
        WHERE rozmowy_statuses.aktywny = 1 AND clients.handlowiec = \''.Auth::id().'\'
        GROUP BY clients.id, clients.nip_pesel, clients.nazwa, clients.adresmiasto, clients.kodpocztowy, clients.miejscowosc, clients.nrtelefonu, 
        clients.handlowiec, rozmowy_statuses.status, clients.kontakt_data,clients.clients.status,clients.clients.created_at,
        clients.clients.updated_at,clients.clients.nieObiera,clients.clients.email,clients.clients.nip
        ORDER BY clients.kontakt_data ASC
        ');
        $data = json_decode(json_encode($data),true);

        return view('clientListActive',["data"=>$data]);
    }

    function listNonActive() {

        $data = DB::select('
        SELECT clients.*, rozmowy_statuses.status AS nameStatus, (SELECT count(id_client) from calls
        WHERE clients.id = calls.id_client) AS countCalls
        FROM `clients`
        LEFT JOIN calls ON clients.id = calls.id_client
        LEFT JOIN rozmowy_statuses ON clients.status = rozmowy_statuses.id
        WHERE rozmowy_statuses.aktywny=2 AND clients.handlowiec = \''.Auth::id().'\'
        GROUP BY clients.id, clients.nip_pesel, clients.nazwa, clients.adresmiasto, clients.kodpocztowy, clients.miejscowosc, clients.nrtelefonu, 
        clients.handlowiec, rozmowy_statuses.status, clients.kontakt_data,clients.clients.status,clients.clients.created_at,clients.clients.updated_at,clients.clients.nieObiera,clients.clients.email,clients.clients.nip
        ORDER BY clients.kontakt_data ASC
        ');
        $data = json_decode(json_encode($data),true);

        return view('clientListNonActive',["data"=>$data]);
    }

    function editData($id) {
        $data = Client::find($id);
        $statuses = Rozmowy_status::all();
        $sourceclients = Sourceclient::all();
        $statusFoto = StatusesFoto::all();
        $clientbranza = Client_branza::all();
        $statusPrad =  Prad_status::all();


        $statusAktywnyFoto = Statusesfoto::where('id', $data->statusFoto)->get();

        $statusAktywnyRozmowy = Rozmowy_status::where('id', $data->status)->get();
        $pradkampania = Client_kampania::all();

        $ofertyPrad = DB::table('prad_ofertas')
            ->select('prad_ofertas.*', 'dostawcaprads.firmadostawca as firmadostawca', 'pradtaryfas.taryfa as taryfa')
            ->join('dostawcaprads', 'prad_ofertas.firmadostawca', '=', 'dostawcaprads.id')
            ->join('pradtaryfas', 'prad_ofertas.taryfa', '=', 'pradtaryfas.id')
            ->where('prad_ofertas.archiwum', '=', NULL)
            ->get();

        $pradFaktura = DB::table('prad_fakturas')
            ->select('prad_fakturas.*', 'dostawcaprads.firmadostawca as firmadostawca', 'pradtaryfas.taryfa as taryfa')
            ->join('dostawcaprads', 'prad_fakturas.firmadostawca', '=', 'dostawcaprads.id')
            ->join('pradtaryfas', 'prad_fakturas.taryfa', '=', 'pradtaryfas.id')
            ->where('prad_fakturas.archiwum', '=', NULL)
            ->get();

        $pradBack = DB::table('prad_back_umowas')
            ->select('prad_back_umowas.*', 'dostawcaprads.firmadostawca as firmadostawca', 'pradtaryfas.taryfa as taryfa')
            ->join('dostawcaprads', 'prad_back_umowas.firmadostawca', '=', 'dostawcaprads.id')
            ->join('pradtaryfas', 'prad_back_umowas.taryfa', '=', 'pradtaryfas.id')
            ->where('prad_back_umowas.archiwum', '=', NULL)
            ->get();



        $oferty = Oferta::where('id_client', $id)->get();

        $countOferty = $oferty->count();

        $commentRozmowy = DB::table('rozmowy_comments')
        ->select('rozmowy_comments.*')
        ->where('rozmowy_comments.id_client', $id)
        ->orderBy('rozmowy_comments.created_at', 'DESC')
        ->get();

        $commentFoto = DB::table('commentfotos')
        ->select('commentfotos.*', 'users.name as name')
        ->join('users', 'commentfotos.user', '=', 'users.id')
        ->where('commentfotos.id_client', $id)
        ->orderBy('commentfotos.created_at', 'DESC')
        ->get();

        $commentPrad = DB::table('prad_comments')
        ->select('prad_comments.*', 'users.name as name')
        ->join('users', 'prad_comments.user', '=', 'users.id')
        ->where('prad_comments.id_client', $id)
        ->orderBy('prad_comments.created_at', 'DESC')
        ->get();



        $count = Call::where('id_client', $id)->get();
        $count = $count->count();

        $meetCount = Meeting::where('id_client', $id)->get();
        $meetCount = $meetCount->count();

        $ofertaCaunt = Oferta::where('id_client', $id)->get();
        $ofertaCaunt = $ofertaCaunt->count();


        $lasts = DB::table('calls')
        ->select('calls.id_client', 'calls.created_at')
        ->where('calls.id_client', $id)
        ->orderBy('calls.created_at', 'desc')
        ->latest()
        ->get();

        $users = User::query()->get();


        return view('clientEdit', compact('data','statuses','commentRozmowy', 'count', 'lasts', 'meetCount', 
        'users', 'oferty', 'countOferty', 'sourceclients', 'statusFoto', 'statusAktywnyFoto', 'statusAktywnyRozmowy', 
        'commentFoto', 'ofertyPrad', 'statusPrad', 'ofertaCaunt', 'pradFaktura', 'pradBack', 'pradkampania', 
        'clientbranza', 'commentPrad'));
    }


    function updateKlient(ShareFormRequest $req) {

            $data = Client::find($req->id);
            $data->adresmiasto=$req->adresmiasto;
            $data->kodpocztowy=!empty($req->kodpocztowy) ?  $req->kodpocztowy : '';
            $data->miejscowosc=$req->miejscowosc;
            $data->nrtelefonu=$req->nrtelefonu;
            $data->handlowiec=$req->handlowiec;
            $data->email=$req->email;
            $data->nip=$req->nip;
            $data->sourceKlient=$req->statusSource; 
            $data->osobakontaktowa=$req->osobakontaktowa;
            $data->kampania=$req->kampania;
            $data->branza=$req->branza;

            $save = $data->save();
            
            if($save) {
            Session::flash('saveform', 'Zapisano');
            return redirect('/klient/'.$data->id);  
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

    function formKlient() {

        $statuses = Rozmowy_status::all();
        $users = User::all();
        $sourceclients = Sourceclient::all();
        $pradkampania = Client_kampania::all();
        $clientbranza = Client_branza::all();

        return view('clientForm', compact('statuses', 'users', 'sourceclients', 'pradkampania', 'clientbranza'));
    }

    function testGus(Request $req) {   
        
    $gus = new GusApi('a8168abb80eb4cf2a16b');
    //for development server use:
    try {
        $nipToCheck = $req->input('nip'); //change to valid nip value
        $gus->login();

        $gusReports = $gus->getByNip($nipToCheck);

        // var_dump($gus->dataStatus());
        // var_dump($gus->getBulkReport(
        //     new DateTimeImmutable('2019-05-31'),
        //     BulkReportTypes::REPORT_UPDATED_LEGAL_ENTITY_AND_NATURAL_PERSON ));
        
        $gusArr = array();

        foreach ($gusReports as $gusReport) {
            //you can change report type to other one
            $reportType = ReportTypes::REPORT_PERSON;
            // echo $gusReport->getName();
            // echo $gusReport->getCity();
            // echo 'Address: '. $gusReport->getStreet(). ' ' . $gusReport->getPropertyNumber() . '/' . $gusReport->getApartmentNumber();
            // $fullReport = $gus->getFullReport($gusReport, $reportType);
            // var_dump($fullReport);
            array_push($gusArr, $gusReport->getName());
            array_push($gusArr, $gusReport->getCity());
            array_push($gusArr, $gusReport->getStreet());
            array_push($gusArr, $gusReport->getPropertyNumber());
            array_push($gusArr, $gusReport->getApartmentNumber());
            array_push($gusArr, $gusReport->getZipCode());
            return $gusArr;
        }

    } catch (InvalidUserKeyException $e) {
        echo 'Bad user key';
    } catch (NotFoundException $e) {
        echo 'No data found <br>';
        echo 'For more information read server message below: <br>';
        echo $gus->getResultSearchMessage();
    }
}


    function insertKlient(ShareFormRequest $req) {

        $checkNip = Client::where('nip', $req->nip)->get();
        // dd($checkNip);
        foreach ($checkNip as $item) {

        }

        if (!$checkNip->isEmpty()) { 
            Session::flash('NIPexist');
            return redirect('/klient/'.$item->id);
        } else {
            $today = new DateTime('NOW');
            $today = $today->format('Y-m-d');

            $data = new Client;
            $data->nazwa=$req->nazwa;
            $data->adresmiasto=$req->adresmiasto;
            $data->kodpocztowy= !empty($req->kodpocztowy) ?  $req->kodpocztowy : '';
            $data->miejscowosc=$req->miejscowosc;
            $data->nrtelefonu=$req->nrtelefonu;
            $data->status=1;
            $data->handlowiec=$req->handlowiec;
            $data->kontakt_data=$today;
            $data->nieObiera='0';
            $data->email=$req->email;
            $data->nip=$req->nip;
            $data->sourceKlient=$req->statusSource; 
            $data->osobakontaktowa=$req->osobakontaktowa;
            $data->kampania=$req->kampania;
            $data->branza=$req->branza;
            $data->statusFoto=0;
            $data->statusPrad=$req->statusPrad;




            $saved = $data->save();
            $data->id;
            
            // if ($req->comment) {
            //     $comment = new Comment;
            //     $comment->id_client = $data->id;
            //     $comment->comment = $req->comment;
            //     $comment->save();
            // }

            if($saved) {
            Session::flash('saveform', 'Zapisano');
            return redirect('/klient/'.$data->id);  
            }
        }
    }
}