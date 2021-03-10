<?php

namespace App\Http\Controllers;

use App\Models\Solarname;
use App\Models\Cennik;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\CennikFormRequest;

use Illuminate\Support\Facades\Session;


class CennikController extends Controller
{
    function list() {

        $solarName = Solarname::all();

        // $cennik = Cennik::orderBy('moc')->get();

        $cennik = DB::table('cenniks')
            ->join('solarnames', 'cenniks.firma','solarnames.id')
            ->select('cenniks.*', 'solarnames.*')
            ->orderBy('firma', 'asc')
            ->orderBy('ilModulow', 'asc')
            ->get();


        return view('cennikList', compact('solarName', 'cennik'));
    }

    function insert(CennikFormRequest $req) {

        $data = new Cennik;
        $data->ilModulow=$req->ilModulow;
        $data->firma=$req->firma;
        $data->moc=$req->mocInstalacji;
        $data->plaski=$req->plaski;
        $data->skosny=$req->skosny;
        $data->grunt=$req->grunt;

        $data->save();

        Session::flash('saveform', 'Zapisano');

        return redirect('cennik');

    }

}
