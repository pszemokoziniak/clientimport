@extends('layouts.app')


@section('content')

<div class="container">
<a href="javascript:history.back()" class="btn btn-secondary btn-block">Cofnij</a>

<h1>Kampania Prąd</h1>
    <table class="table">
        <thead>
            <tr>
                <!-- <th scope="col">Id</th> -->
                <th scope="col">Kampania Prąd</th>
                <th scope="col">Akcja</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <!-- <td>{{$item->id}}</td> -->
                <td><strong>{{$item->kampania}}</strong></td>

                <td>
                    <a type="button" class="btn btn-primary w-25" href={{"kampaniaPradEdit/".$item->id}}>Popraw</a>
                    <a type="button" class="btn btn-danger w-25" href={{"kampaniaPradDelete/".$item->id}}>Usuń</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button onclick="location.href='{{ url('kampaniaPradAdd') }}'" class="btn btn-primary float-right">Dodaj Kampanie</button>
</div>
@endsection