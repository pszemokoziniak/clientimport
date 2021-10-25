@extends('layouts.app')


@section('content')

<div class="container">

    <table style="width:90%" id="table_my" class="table table-hover">
        <thead>
            <tr>
                <td>Akcja</td><td>Klient</td><td>Użytkownik</td><td>Data</td>
            </tr>
        </thead>
        <tbody>
            @foreach($loguser as $item)
                    <tr>
                        <td>{{$item->akcja}}</td><td>{{$item->nazwa}}</td><td>{{$item->name}}</td><td> {{$item->created_at}}</td><td> @if(isset($item->id_client))<a href="/klient/{{$item->id_client}}?page=prad"><i class="fas fa-eye fa-3x"></i></a>@endif</td>
                    </tr>
                <!-- <hr class="my-4"> -->
            @endforeach
        </tbody>
    </table>
</div>
@endsection
