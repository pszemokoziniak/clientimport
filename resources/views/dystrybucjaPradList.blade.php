@extends('layouts.app')


@section('content')

<div class="container">
<h1>Dystrybucja Prąd</h1>
    <table class="table">
        <thead>
            <tr>
                <!-- <th scope="col">Id</th> -->
                <th scope="col">Dystrybucja Prądu</th>
                <th scope="col">Akcja</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <!-- <td>{{$item->id}}</td> -->
                <td><strong>{{$item->dystrybucja}}</strong></td>

                <td>
                    <a type="button" class="btn btn-primary w-25" href={{"dystrybucjaPradEdit/".$item->id}}>Popraw</a>
                    <a type="button" class="btn btn-danger w-25" href={{"dystrybucjaPradDelete/".$item->id}}>Usuń</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button onclick="location.href='{{ url('dystrybucjaPradAdd') }}'" class="btn btn-primary float-right">Dodaj Dystrybucję</button>
</div>
@endsection