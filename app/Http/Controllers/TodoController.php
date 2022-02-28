<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

use App\Models\User;
use App\Models\Todo;
use App\Models\ZadaniaStatus;
use Auth;



class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Todo::with('users', 'statuses')->get();
        // dd($data);
        return view('todo.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses =  ZadaniaStatus::all();
        $users =  User::all();
        $useradmin = Auth::user();
        // $useradmin = auth()->user()->name;

        return view('todo.create', compact('statuses', 'users', 'useradmin'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $data = Todo::with('users', 'statuses')->get();

        $todo = new Todo;
        $todo->temat=$req->nazwa;
        $todo->endTask=$req->doKiedy;
        $todo->status=$req->status;
        $todo->opis=$req->opis;
        $todo->admin=Auth::id();
        $todo->save();

        return view('todo.index', compact('data'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Todo::with('users', 'statuses')->find($id);
        return view('todo.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
