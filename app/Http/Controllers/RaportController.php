<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Call;
use App\Models\User;
use App\Models\Meeting;


class RaportController extends Controller
{
    function list() {
        return view('raport');

    }

    public static function countCalls($id_user) {
        $count = Call::where('id_user', $id_user)->get();
        $count = $count->count();
        return $count;
    }

    public static function countCallsDate($id_user, $date_start, $date_end) {
        $count = Call::where('id_user', $id_user)
        ->where('created_at','>=', $date_start)
        ->where('created_at','<=', $date_end)
        ->get();
        $count = $count->count();
        return $count;
    }

    public static function countMeeting($id_user) {
        $count = Meeting::where('id_user', $id_user)->get();
        $count = $count->count();
        return $count;
    }



    public static function nameUser($id_user) {
        $name = User::where('id', $id_user)->first();
        $name = $name->name;
        return $name;
    }


    // function userCalls() {
    //     $user = User::query()->get();
    //     return view('raport', ["data"=>$user]);
    // }

    function userCallsDate(Request $req) {

        if (!empty($req->start_data)) {
            $start = $req->start_data;
        } else {
            $start = '2020-01-01';
        }

        if (!empty($req->end_data)) {
            $end = $req->end_data;
        } else {
            $end = date('Y-m-d');
        }

        $user = User::query()->get();
        return view('raport', compact('user','start','end'));
    }

    

    // function  UserCallsTest(Request $req) {
    
    //     $user = DB::table('Users')
    //     ->select('users.id', 'calls.updated_at')
    //     ->join('Calls', 'users.id', 'calls.id_user')
    //     ->groupBy('users.id', 'calls.updated_at')
    //     ->get();

    //     // dd($user);
    
    
    //     $user = User::query()->get();

    //     return view('raport', ["data"=>$user]);

    // }
}
