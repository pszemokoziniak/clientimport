<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;


use App\Models\Call;
use App\Models\User;
use App\Models\Meeting;
use App\Models\Client;


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
        
        $date_end = new DateTime($date_end);
        $date_end->add(new DateInterval('P1D'));

        $count = Call::where('id_user', $id_user)
        ->where('created_at','>=', $date_start)
        ->where('created_at','<=', $date_end)
        ->get();
        $count = $count->count();
        return $count;
    }

    public static function countMeetingAll($id_user) {
        $count = Meeting::where('id_user', $id_user)->get();
        $count = $count->count();
        return $count;
    }

    public static function countMeeting($id_user, $date_start, $date_end) {
        $count = Meeting::where('id_user', $id_user)
        ->where('meet_date','>=', $date_start)
        ->where('meet_date','<=', $date_end)
        ->get();
        $count = $count->count();
        return $count;
    }

    function countMeetingDetale(Request $req) {

        $date_start = $req->start_data;
        $count = Meeting::where('id_user', '1')
        ->where('meet_date','>=', $req->start_data)
        ->where('meet_date','<=', $req->$end_data)
        ->get();
        return view('raport', ["data"=>$count]);
    }

    public static function countMeetingPlanowane($id_user, $date_start, $date_end) {
        $count = Client::where('handlowiec', $id_user)
        ->where('status', '2')
        ->where('updated_at','>=', $date_start)
        ->where('updated_at','<=', $date_end)
        ->get();
        $count = $count->count();
        return $count;
    }

    public static function countMeetingPlanowaneAll($id_user) {
        $count = Client::where('handlowiec', $id_user)
        ->where('status', '2')
        ->get();
        $count = $count->count();
        return $count;
    }

    public static function nameUser($id_user) {
        $name = User::where('id', $id_user)->first();
        $name = $name->name;
        return $name;
    }

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

        // $start_data = $req->start_data;
        $meeting = DB::table('meetings')
        ->where('id_user', 1)
        ->whereBetween('meet_date', [$start, $end])
        ->get();
        
        // dd($meeting);
        
        $user = User::query()->get();
        return view('layouts.raport', compact('user','start','end','meeting'));
    }
}
