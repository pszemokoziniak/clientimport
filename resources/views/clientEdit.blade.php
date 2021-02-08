<?php 
    use App\Http\Controllers\RaportController;
?>

@extends('layouts.app')


@section('content')
<div class="container">

    <a type="button" class="btn btn-success w-25 my-3" href={{"/setNieobiera/".$data['id']}}>Nie Odbiera</a>
    
    @if ($data->status !== 1) 
        @if ($meetCount==0) 
            <a type="button" class="btn btn-success w-25 my-3" href={{"/spotkanie/".$data['id']}}>Dodaj Spotkanie</a>
        @else 
            <a type="button" class="btn btn-primary w-25 my-3" href={{"/spotkanie/edit/".$data['id']}}>Detale Spotkania</a>
        @endif
    @endif

    <form action="/klient" method="post" id="formEdit">
        @csrf
        <input type="hidden" name="id" value="{{$data['id']}}">


        <div class="jumbotron">
            <h1 class="display-5">Dane Klienta</h1>
            <h5 class="display-5">Wykonane telefony: {{$count}} 
                @foreach($lasts as $last)
                    -- <small>{{$last->created_at}}</small>
                @endforeach
            </h5>

            <button type="button" id="unblock" class="btn btn-primary btn-block">Edit</button>
            @if ($data->status == 1) 
                <a href="/" class="btn btn-secondary btn-block">Cofnij</a>
            @else
                <a href="/klienciAktywni" class="btn btn-secondary btn-block">Cofnij</a>
            @endif


            <hr class="my-4">
                @foreach($comments as $comment)
                    <h5 class="display-10">{{$comment->comment}} </h5>
                    <p><small>{{$comment->created_at}}</small></p>
                    <hr class="my-4">

                @endforeach
            
            <!-- <hr class="my-4"> -->
            <p class="lead"><span style="width:150px; display:inline-block;">Nazwa</span> <input class="w-75"
                    type="text" name="nazwa" value="{{$data['nazwa']}}" disabled></p>
            <p class="lead"><span style="width:150px; display:inline-block;">Adres</span> <input class="w-50"
                    type="text" disabled name="adresmiasto" value="{{$data['adresmiasto']}}" disabled> <input
                    type="text" name="kodpocztowy" value="{{$data['kodpocztowy']}}" disabled></p>
            <p class="lead"><span style="width:150px; display:inline-block;">Miejscowość</span> <input class="w-50"
                    type="text" disabled name="miejscowosc" value="{{$data['miejscowosc']}}" disabled></p>
            <p class="lead"><span style="width:150px; display:inline-block;">Numer Tel.</span> <input type="text"
                    name="nrtelefonu" value="{{phone($data['nrtelefonu'], 'PL')->formatNational()}}" disabled>
                Status <select name="status" disabled>
                    @foreach($statuses as $status)
                    <option value="{{$status['id']}}" {{$data->status == $status->id ? 'selected' : '' }}>
                        {{$status['status']}}</option>
                    @endforeach
                </select>
                Data Kontaktu <input type="date" name="kontakt_data" value="{{$data['kontakt_data']}}" disabled>
            </p>
            <!-- <p class="lead"><span style="width:150px; display:inline-block;">Handlowiec</span> <input type="text"
                    name="handlowiec" value="{{RaportController::nameUser($data['handlowiec'])}}" disabled></p> -->
            <p class="lead"><span style="width:150px; display:inline-block;">Handlowiec</span>         
                <select name="handlowiec" disabled>
                    @foreach($users as $user)
                    <option value="{{$user['id']}}" {{$data->handlowiec == $user->id ? 'selected' : '' }}>
                        {{$user['name']}}</option>
                    @endforeach
                </select>

            <hr class="my-4">

            <div class="form-group">
                <p class="lead">Dodaj Komentarz</p>
                <textarea class="form-control" name="comment" id="" rows="3"></textarea>
            </div>
            <button type="button" id="save" class="btn btn-success btn-block">Zapisz</button>
        </div>


    </form>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $("#save").click(function() {
        event.preventDefault();
        $('input:disabled').removeAttr('disabled');
        $('select:disabled').removeAttr('disabled');

        $("#formEdit").submit();
    });
    $("#unblock").click(function() {
        $('input:disabled').removeAttr('disabled');
        $('select:disabled').removeAttr('disabled');
    });

});
</script>