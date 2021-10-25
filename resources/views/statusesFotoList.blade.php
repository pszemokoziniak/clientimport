@extends('layouts.app')


@section('content')

<div class="container">
<h1>Staus Fotowoltaika</h1>
    <table class="table">
        <thead>
            <tr>
                <!-- <th scope="col">Id</th> -->
                <th scope="col">Status Foto</th>
                <th scope="col">Aktywny</th>
                <th scope="col">Akcja</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <!-- <td>{{$item->id}}</td> -->
                <td><strong>{{$item->status}}</strong></td>
                <td><strong>
                @if ($item->aktywny == 1)
                    Tak
                @elseif ($item->aktywny == 2)
                    Nie
                @endif
                </strong></td>

                <td>
                    <a type="button" class="btn btn-primary w-25" href={{"statutesFotoEdit/".$item->id}}>Popraw</a>
                    <a type="button" class="btn btn-danger w-25" href={{"statutesFotoDelete/".$item->id}}>Usuń</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button onclick="location.href='{{ url('statusesFotoAdd') }}'" class="btn btn-primary float-right">Dodaj status</button>
</div>
@endsection