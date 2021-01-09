@extends('layouts.app')


@section('content')

<div class="container">
    <form action="/export-excel" method="post" id="">
        @csrf
        <fieldset>
            <div class="form-group row">
                <label for="start_data" class="col-sm-1 col-form-label">Start</label>
                <div class="col-sm-3">
                    <input type="date" name="start_data" class="form-control">
                </div>
                <label for="end_data" class="col-sm-1 col-form-label">Koniec</label>
                <div class="col-sm-3">
                    <input type="date" name="end_data" class="form-control">
                </div>
            </div>
            <button type="submit" id="" class="btn btn-primary btn-block">Eksport do Excel</button>
            <a type="button" href="/import-form" class="btn btn-success btn-block">Import z Excel</a>
        </fieldset>
    </form>
    <!-- <a href="{{url('export-excel')}}" class="btn btn-primary btn-block">Eksport do Excel</a> -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nazwa</th>
                <!-- <th scope="col">Adres</th> -->
                <th scope="col">Telefon</th>
                <th scope="col">Handlowiec</th>
                <th scope="col">Status</th>
                <th scope="col">Kontakt Data</th>
                <!-- <th scope="col">Operacje</th> -->

            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)

            <tr style="cursor:pointer" onclick="javascript:location.href='editclient/{{$item->id}}'">
                <td>{{$item->nazwa}}</td>
                <!-- <td>{{$item->adresmiasto}}</td> -->
                <td>{{phone($item->nrtelefonu, 'PL')->formatNational()}}</td>
                <td>{{$item->handlowiec}}</td>
                <td>{{$item->status}}</td>
                <td>{{$item->kontakt_data}}</td>
                <!-- <td><a href="edit/".{{$item->id}}>Edytuj</a></td> -->
            </tr>
            @endforeach
        </tbody>
    </table>
    <button onclick="location.href='{{ url('addstatus') }}'" class="btn btn-primary float-right">Dodaj status</button>
</div>
@endsection