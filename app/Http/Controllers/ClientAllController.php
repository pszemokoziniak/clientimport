<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ClientAllController extends Controller
{
    // function index(){
    //     $data = DB::table('clients')
    //     ->select('clients.*', 'users.name', 'client_kampanias.kampania', 'client_branzas.branza')
    //     ->join('users', 'clients.handlowiec', '=', 'users.id')
    //     ->join('client_kampanias', 'clients.kampania', '=', 'client_kampanias.id')
    //     ->join('client_branzas', 'clients.branza', '=', 'client_branzas.id')
    //     ->get();

    //     return view('clientAll', compact('data'));

    // }
    function index()
    {
        $data = DB::table('clients')
        ->select('clients.*', 'users.name', 'client_kampanias.kampania', 'client_branzas.branza')
        ->join('users', 'clients.handlowiec', '=', 'users.id')
        ->join('client_kampanias', 'clients.kampania', '=', 'client_kampanias.id')
        ->join('client_branzas', 'clients.branza', '=', 'client_branzas.id')
        ->get();

        $total_row_index = $data->count();


        return view('clientAll', compact('data', 'total_row_index'));
    }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $miasto = $request->get('miasto');
      $handlowiec = $request->get('handlowiec');
      $branza = $request->get('branza');
      $kampania = $request->get('kampania');
      $klient = $request->get('klient');


      if($miasto != '' OR $handlowiec != '' OR $branza != '' OR $kampania != '' OR $klient != '')
      {
       $data = DB::table('clients')
       ->select('clients.*', 'users.name', 'client_kampanias.kampania', 'client_branzas.branza')
       ->join('users', 'clients.handlowiec', '=', 'users.id')
       ->join('client_kampanias', 'clients.kampania', '=', 'client_kampanias.id')
       ->join('client_branzas', 'clients.branza', '=', 'client_branzas.id')
         ->where('users.name', 'like', '%'.$handlowiec.'%')
         ->where('client_branzas.branza', 'like', '%'.$branza.'%')
         ->where('client_kampanias.kampania', 'like', '%'.$kampania.'%')
         ->where('clients.miejscowosc', 'like', '%'.$miasto.'%')
         ->where('clients.nazwa', 'like', '%'.$klient.'%')
         ->orderBy('users.name', 'asc')
         ->get();
         
      }
      else
      {
        $data = DB::table('clients')
        ->select('clients.*', 'users.name', 'client_kampanias.kampania', 'client_branzas.branza')
        ->join('users', 'clients.handlowiec', '=', 'users.id')
        ->join('client_kampanias', 'clients.kampania', '=', 'client_kampanias.id')
        ->join('client_branzas', 'clients.branza', '=', 'client_branzas.id')
        ->get();
      }

      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
            <td>'.$row->nazwa.'</td>
            <td>'.$row->miejscowosc.'</td>
            <td>'.$row->branza.'</td>
            <td>'.$row->kampania.'</td>
            <td>'.$row->name.'</td>
            <td><a href="/klient/'.$row->id.'" title="Zobacz"><i class="fas fa-edit fa-2x" style="color:blue; cursor:pointer;"> </i></a></td>
            <i class="fas fa-broom"></i>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">Brak Klientów</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
}