@extends('layouts.app')


@section('content')

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <!-- <th scope="col">Id</th> -->
                <th scope="col">Użytkownik</th>
                <th scope="col">Email</th>
                <th scope="col">Telefon</th>
                <th scope="col">Admin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <!-- <td>{{$item->id}}</td> -->
                <td><strong>{{$item->name}}</strong></td>
                <td><strong>{{$item->email}}</strong></td>
                <td><strong>{{$item->phone}}</strong></td>
                <td><strong>{{$item->admin_level}}</strong></td>

                <td>
                    <a type="button" class="btn btn-primary w-50" href={{"userEdit/".$item->id}}>Popraw</a><br />
                    <a type="button" class="btn btn-danger w-50" href={{"userDelete/".$item->id}}>Usuń</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button onclick="location.href='{{ route('register') }}'" class="btn btn-primary float-right">Dodaj użytkownika</button>
</div>
@endsection