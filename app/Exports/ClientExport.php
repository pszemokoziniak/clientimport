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
            'nip_pesel',
            'nazwa',
            'adresmiasto',
            'kodpocztowy',
            'miejscowosc',
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
        SELECT clients.id, clients.nip_pesel, clients.nazwa, clients.adresmiasto, clients.kodpocztowy, clients.miejscowosc, clients.nrtelefonu, clients.handlowiec, rozmowy_statuses.status, clients.kontakt_data,
		GROUP_CONCAT(rozmowy_comments.comment ORDER BY rozmowy_comments.comment SEPARATOR " | ") as comment
        FROM `clients`
        LEFT JOIN rozmowy_comments ON clients.id = rozmowy_comments.id_client
        LEFT JOIN rozmowy_statuses ON clients.status = rozmowy_statuses.id
        WHERE clients.created_at >= "'.$this->start_data.'" AND clients.created_at <= "'.$this->end_data.'"
        GROUP BY clients.id, clients.nip_pesel, clients.nazwa, clients.adresmiasto, clients.kodpocztowy, clients.miejscowosc, clients.nrtelefonu, clients.handlowiec, rozmowy_statuses.status, clients.kontakt_data
        ');
        $records = json_decode(json_encode($records),true);
        return collect($records);
    }
}


