@extends('layouts.app')


@section('content')

<div class="container">
<h1>Status Prąd</h1>
    <table class="table">
        <thead>
            <tr>
                <!-- <th scope="col">Id</th> -->
                <th scope="col">Status Prąd</th>
                <th scope="col">Aktywny</th>
                <th scope="col">Akcja</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <!-- <td>{{$item->id}}</td> -->
                <td><strong>{{$item->statusPrad}}</strong></td>
                <td><strong>
                    @if ($item->aktywny == 1)
                        Tak
                    @elseif ($item->aktywny == 2)
                        Nie
                    @endif
                </strong></td>

                <td>
                    <a type="button" class="btn btn-primary w-25" href={{"statusOfertaPradEdit/".$item->id}}>Popraw</a>
                    <a type="button" class="btn btn-danger w-25" href={{"statusOfertaPradDelete/".$item->id}}>Usuń</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button onclick="location.href='{{ url('statusOfertaPradAdd') }}'" class="btn btn-primary float-right">Dodaj</button>
</div>
@endsection