<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Client extends Model
{
    use HasFactory;

    protected $fillable = ['nip_pesel','nazwa','adresmiasto','kodpocztowy','miejscowosc','nrtelefonu','handlowiec','status','kontakt_data'];

}



