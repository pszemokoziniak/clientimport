<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

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

            'nazwa' => $row['nazwa'],
            'adresmiasto' => $row['adresmiasto'],
            'kodpocztowy' => $row['kodpocztowy'],
            'nrtelefonu' => $row['nrtelefonu'],
            'handlowiec' => $row['handlowiec'],
            'status' => '1',
            'kontakt_data' => $date,

        ]);
    }
}
