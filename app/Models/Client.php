<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Client extends Model
{
    use HasFactory;

    protected $fillable = ['nazwa','adresmiasto','kodpocztowy','nrtelefonu','handlowiec','status','kontakt_data'];


    // public static function getClient() {
    //     $records = DB::select('
    //     SELECT clients.id, clients.nazwa, clients.adresmiasto, clients.kodpocztowy, clients.nrtelefonu, clients.handlowiec, statuses.status, clients.kontakt_data,
	// 	GROUP_CONCAT(comments.comment ORDER BY comments.comment SEPARATOR " | ") as comment
    //     FROM `clients`
    //     LEFT JOIN comments ON clients.id = comments.id_client
    //     LEFT JOIN statuses ON clients.status = statuses.id
    //     GROUP BY clients.id, clients.nazwa, clients.adresmiasto, clients.kodpocztowy, clients.nrtelefonu, clients.handlowiec, statuses.status, clients.kontakt_data
    //     ');
    //     $records = json_decode(json_encode($records),true);
    //     return $records;
    // }
}
//        ->select('nazwa','adresmiasto','kodpocztowy','nrtelefonu','handlowiec','statuses.status','kontakt_data','group_concat(comments.comment)')
        // ->join('comments','clients.id','comments.id_client')
        // DB::raw('(SELECT comments.comment FROM comments
        // WHERE comments.id_client=clients.id) as comment'))

        // DB::table('comments')
        // ->select('comments.comment')
        // ->where('comments.id_client,clients.id'))

        // $records = DB::table('clients')
        // ->select('clients.id','nazwa','adresmiasto','kodpocztowy','nrtelefonu','handlowiec','statuses.status','kontakt_data',
        // DB::raw('group_concat(comments.comment ORDER BY comments.comment) as comment'))
        // ->join('comments ','clients.id','comments.id_client')
        // ->join('statuses','clients.status','statuses.id')
        // ->groupBy('clients.id')
        // ->get()->toArray();
        // return $records;


