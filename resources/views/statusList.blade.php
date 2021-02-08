@extends('layouts.app')


@section('content')

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Status</th>
                <th scope="col">Akcja</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->status}}</td>
                <td>
                    <a type="button" class="btn btn-primary w-25" href={{"statusEdit/".$item->id}}>Popraw</a>
                    <a type="button" class="btn btn-danger w-25" href={{"statusDelete/".$item->id}}>Usuń</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button onclick="location.href='{{ url('statusAdd') }}'" class="btn btn-primary float-right">Dodaj status</button>
</div>
@endsection