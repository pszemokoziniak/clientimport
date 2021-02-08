<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Auth;

class ClientImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $date = date('Y-m-d');
        return new Client([
            'nip_pesel' => $row['nip_pesel'],
            'nazwa' => $row['nazwa'],
            'adresmiasto' => $row['adresmiasto'],
            'kodpocztowy' => $row['kodpocztowy'],
            'miejscowosc' => $row['miejscowosc'],
            'nrtelefonu' => $row['nrtelefonu'],
            'handlowiec' =>  Auth::id(),
            'status' => '1',
            'kontakt_data' => $date,
            'nieObiera' => '0'

        ]);
    }
}
