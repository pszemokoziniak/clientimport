@extends('layouts.app')


@section('content')

<div class="container">
<a href="javascript:history.back()" class="btn btn-secondary btn-block">Cofnij</a>

    <table class="table">
        <thead>
            <tr>
                <!-- <th scope="col">Id</th> -->
                <th scope="col">Źródło</th>
                <th scope="col">Akcja</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <!-- <td>{{$item->id}}</td> -->
                <td><strong>{{$item->source}}</strong></td>
                <td>
                    <a type="button" class="btn btn-primary w-25" href={{"sourceEdit/".$item->id}}>Popraw</a>
                    <a type="button" class="btn btn-danger w-25" href={{"sourceDelete/".$item->id}}>Usuń</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button onclick="location.href='{{ url('sourceAdd') }}'" class="btn btn-primary float-right">Dodaj źródło</button>
</div>
@endsection