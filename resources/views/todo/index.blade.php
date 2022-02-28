@extends('layouts.app')


@section('content')

<div class="container">
<a href="javascript:history.back()" class="btn btn-secondary btn-block">Cofnij</a>

<h1>Zadania</h1>
    <table class="table">
        <thead>
            <tr>
                <!-- <th scope="col">Id</th> -->
                <th scope="col">Nazwa</th>
                <th scope="col">Do Kiedy</th>
                <th scope="col">Status</th>
                <th scope="col">Data</th>
                <th scope="col">Opis</th>

            </tr>
        </thead>
        <tbody>
        @foreach ($data as $item)
        <!-- {{ dd($data) }} -->
            <tr>
                <td>{{$item->temat}}</td>
                <td>{{$item->endTask}}</td>
                <td>{{$item->statuses->status}}</td>
                <td>{{$item->users->name}}</td>
                <td>{{$item->opis}}</td>

                <td>
                    <a type="button" class="btn btn-primary w-25" href={{"zadania/edit/".$item->id}}>Edycja</a>
                    <a type="button" class="btn btn-danger w-25" href={{"zadania/delete/".$item->id}}>Usuń</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button onclick="location.href='{{ url('ClientBranzaAdd') }}'" class="btn btn-primary float-right">Dodaj Branże</button>
</div>
@endsection