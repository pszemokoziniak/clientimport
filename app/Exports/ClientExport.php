<?php

namespace App\Exports;

use App\Models\Client;
use App\Models\Comment;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;


class ClientExport implements FromCollection,WithHeadings
{
    function headings():array{
        return[
            'id',
            'nazwa',
            'adresmiasto',
            'kodpocztowy',
            'nrtelefonu',
            'handlowiec',
            'status',
            'data kontaktu',
            'komentarzhandlowca'
        ];
    }
    
    protected $start_data,$end_data;

    function __construct($start_data, $end_data) {
        $this->start_data = $start_data;
        $this->end_data = $end_data;

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $start = $this->start_data;
        // dd('test', $start);

        $records = DB::select('
        SELECT clients.id, clients.nazwa, clients.adresmiasto, clients.kodpocztowy, clients.nrtelefonu, clients.handlowiec, statuses.status, clients.kontakt_data,
		GROUP_CONCAT(comments.comment ORDER BY comments.comment SEPARATOR " | ") as comment
        FROM `clients`
        LEFT JOIN comments ON clients.id = comments.id_client
        LEFT JOIN statuses ON clients.status = statuses.id
        WHERE clients.created_at >= "'.$this->start_data.'" AND clients.created_at <= "'.$this->end_data.'"
        GROUP BY clients.id, clients.nazwa, clients.adresmiasto, clients.kodpocztowy, clients.nrtelefonu, clients.handlowiec, statuses.status, clients.kontakt_data
        ');
        $records = json_decode(json_encode($records),true);
        return collect($records);
    }
}


        // $records = DB::table('clients')
        // ->select('clients.id','clients.nazwa','clients.adresmiasto','clients.kodpocztowy','clients.nrtelefonu','clients.handlowiec','statuses.status','clients.kontakt_data',
        // DB::raw('GROUP_CONCAT(comments.comment ORDER BY comments.comment) as comment'))
        // ->leftjoin('comments ','clients.id','=','comments.id_client')
        // ->leftjoin('statuses','clients.status','=','statuses.id')
        // ->groupBy('clients.id', 'clients.nazwa', 'clients.adresmiasto', 'clients.kodpocztowy', 'clients.nrtelefonu', 'clients.handlowiec', 'statuses.status', 'clients.kontakt_data')
        // ->get()->toArray();
        // return collect($records);

        // return $records;
        //return Client::all();


