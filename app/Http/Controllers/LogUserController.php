<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Log_user;


class LogUserController extends Controller
{
    function list() {
    $logs = Log_user::all();
    return view('logUser', compact('logs'));
    }

    function log_list()
    {
    	$loguser = Log_user::join('clients', 'clients.id', '=', 'log_users.user')
                    ->join('users', 'users.id', '=', 'log_users.user')
                    ->orderBy('log_users.created_at', 'desc')
              		->get(['log_users.akcja', 'clients.nazwa', 'log_users.created_at', 'log_users.id_client', 'users.name']);


        return view('logUser', compact('loguser'));
    }
}
