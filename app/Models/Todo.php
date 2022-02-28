<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\ZadaniaStatus;


class Todo extends Model
{
    use HasFactory;


        public function users()
        {
            return $this->hasMany(User::class, 'id', 'user');
        }
        public function statuses()
        {
            return $this->hasOne(ZadaniaStatus::class, 'id', 'status');
        }
    
}
