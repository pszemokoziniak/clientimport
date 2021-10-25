<?php 
    use App\Http\Controllers\RaportController;
    // use App\Http\Controllers\FotoOfertaEmailController; 

?>

@extends('layouts.app')


@section('content')

@inject('provider', 'App\Http\Controllers\FotoOfertaEmailController')

<div class="container">

    <!-- <a type="button" class="btn btn-success w-25 my-3" href={{"/kalkulator/".$data['id']}}>Kalkulator</a> -->
    <a type="button" href="/klientForm" class="btn btn-primary btn-block">Wprowadź Klienta</a>

    <!-- @if ($data->status == 1) 
                <a type="button" href="/klientForm" class="btn btn-warning btn-block">Wprowadź Klienta</a>
                <a href="/" class="btn btn-secondary btn-block">Cofnij</a>
            @else
                <a type="button" href="/klientForm" class="btn btn-warning btn-block">Wprowadź Klienta</a>
                <a href="/klienciAktywni" class="btn btn-secondary btn-block">Cofnij</a>
    @endif -->
    <a type="button" class="btn btn-success w-20 my-3" style="width:15%" id="klient">Klient</a>

    @foreach($statusAktywnyRozmowy as $rozmowy)
        <!-- $item->aktywny -->
    @endforeach

    @if ($rozmowy->aktywny == 2) 
    <a type="button" class="btn btn-danger w-20 my-3" style="width:15%" id="rozmowy">Rozmowy</a>
    @else
    <a type="button" class="btn btn-success w-20 my-3" style="width:15%" id="rozmowy">Rozmowy</a>
    @endif

    @foreach($statusAktywnyFoto as $foto)
        <!-- $item->aktywny -->
    @endforeach

    @if ($foto->aktywny == 2) 
        <a type="button" class="btn btn-danger w-20 my-3" style="width:15%" id="fotowoltaika">Fotowoltaika</a>
        @else
        <a type="button" class="btn btn-success w-20 my-3" style="width:15%" id="fotowoltaika">Fotowoltaika</a> 
    @endif
    <a type="button" class="btn btn-success w-20 my-3" style="width:15%" id="prad">Prąd</a>
    <a type="button" class="btn btn-success w-20 my-3" style="width:15%" id="gaz">Gaz</a>

        @include('rozmowy')
        @include('foto')
        @include('prad')
        @include('client')

</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    var pathname = window.location.pathname; // Returns path only (/path/example.html)
    var url      = window.location.href;     // Returns full URL (https://example.com/path/example.html)
    var origin   = window.location.origin; 
    // var url_string = "http://www.example.com/t.html?a=1&b=3&c=m2-m3-m4-m5"; //window.location.href
    var url = new URL(url);
    var page = url.searchParams.get("page");
    $("#klient_"+page).show();

    // console.log(page);


    $("#save").click(function() {
        event.preventDefault();
        $('input:disabled').removeAttr('disabled');
        $('select:disabled').removeAttr('disabled');

        const trim = async () => {
            $("#nrtelefonu").val($("#nrtelefonu").val().replace(/\s/g, ""));
        }

        const save = async () => {
            const saveend = await trim ()
            await $("#form").submit();
        }

        save();

    });

    $("#save_rozmowy").click(function() {
        event.preventDefault();

        const save_rozmowy = $("#form_rozmowy").submit();
        

        save_rozmowy();

    });

    $("#save_foto").click(function() {
        event.preventDefault();

        const save_rozmowy = $("#form_foto").submit();
        

        save_rozmowy();

    });

    $("#oferta-btn").click(function() {
        event.preventDefault();

        $(".oferta-btn").toggle();
    });

    $("#klient").click(function() {
        event.preventDefault();

        $("#klient_foto").hide();
        $("#klient_klient").toggle();
        $("#klient_prad").hide();
        $("#klient_rozmowy").hide();


    });
    $("#rozmowy").click(function() {
        event.preventDefault();

        $("#klient_klient").hide();
        $("#klient_foto").hide();
        $("#klient_rozmowy").toggle();
        $("#klient_prad").hide();

    });
    $("#fotowoltaika").click(function() {
        event.preventDefault();

        $("#klient_klient").hide();
        $("#klient_rozmowy").hide();
        $("#klient_foto").toggle();
        $("#klient_prad").hide();
    });
    $("#prad").click(function() {
        event.preventDefault();

        $("#klient_rozmowy").hide();
        $("#klient_prad").toggle();
        $("#klient_foto").hide();
    });

    $("#call-btn").click(function(){
        event.preventDefault();
        $("#call-iframe").toggle();
    }); 

    $("#unblock").click(function() {
        $('input:disabled').removeAttr('disabled');
        $('select:disabled').removeAttr('disabled');
    });




});

</script>