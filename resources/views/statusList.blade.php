@extends('layouts.app')


@section('content')

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <!-- <th scope="col">Id</th> -->
                <th scope="col">Status</th>
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
                @if ($item->id <> 1)
                    <a type="button" class="btn btn-primary w-25" href={{"statusEdit/".$item->id}}>Popraw</a>
                    <a type="button" class="btn btn-danger w-25" href={{"statusDelete/".$item->id}}>Usuń</a>
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button onclick="location.href='{{ url('statusAdd') }}'" class="btn btn-primary float-right">Dodaj status</button>
</div>
@endsection