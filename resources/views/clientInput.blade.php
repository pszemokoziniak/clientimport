<?php 
    use App\Http\Controllers\RaportController;
?>

@extends('layouts.app')


@section('content')
<div class="container">

    <form action="/klientForm" method="post" id="form">
        @csrf

        <div class="jumbotron">

            @if ($errors->any())
                <div class="alert-danger w-50 lead">Formularz nie zapisany</div>

                @foreach ($errors->all() as $error)
                <div class="alert-danger w-50 lead">{{$error}}</div>
                @endforeach
                <br />
            @endif

            <h1 class="display-5">Wprowadź Klienta</h1>

            <!-- <button type="button" id="unblock" class="btn btn-primary btn-block">Edit</button> -->

            <hr class="my-4">

            <!-- <hr class="my-4"> -->
            <div class="col-md form-group row">
                <div class="col">
                    <label for="nazwa" class="lead">Nazwa</label>
                    <input class="w-100 form-control" type="text" name="nazwa" value="{{ old('nazwa') }}" placeholder="wymagane">
                    @error('nazwa')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="nip" class="lead">NIP</label>
                    <input class="w-50 form-control" type="text" name="nip" value="{{ old('nip') }}">
                    @error('nip')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md form-group">
                <label for="adresmiasto" class="lead">Adres</label>
                <input class="w-100 form-control" type="text" name="adresmiasto" value="{{ old('adresmiasto') }}">
                @error('adresmiasto')
                <div class="alert-danger">{{$message}}</div>
                @enderror
            </div>


            <div class="col-md form-group row">
                <div class="col">
                    <label for="miejscowosc" class="lead">Miejscowość</label>
                    <input class="w-100 form-control" type="text" name="miejscowosc" value="{{ old('miejscowosc') }}">
                    @error('miejscowosc')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="col">
                    <label for="kodpocztowy" class="lead">Kod Pocztowy</label>
                    <input class="w-50 form-control" type="text" name="kodpocztowy" value="{{ old('kodpocztowy') }}">
                    @error('kodpocztowy')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md form-group row">
                <div class="col">
                    <label id="nrtelefonu" for="nrtelefonu" class="lead">Numer Tel.</label>
                    <input class="w-75 form-control" type="text" name="nrtelefonu" value="{{ old('nrtelefonu') }}" placeholder="wymagane">
                    @error('nrtelefonu')
                    <div class="alert-danger w-75">{{$message}}</div>
                    @enderror
                </div>

                <div class="col">
                    <label for="email" class="lead">Email</label>
                    <input class="w-75 form-control" type="text" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="alert-danger w-75">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md form-group">
                <label for="hanlowiec" class="lead">Handlowiec</label>
                <select class="w-25 form-control" name="handlowiec">
                    <option value="wybierz">wybierz</option>

                    @foreach($users as $user)
                    <option value="{{$user['id']}}">
                        {{$user['name']}}</option>
                    @endforeach
                </select>
                @error('handlowiec')
                <div class="alert-danger w-25">{{$message}}</div>
                @enderror
            </div>

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

        $("#nrtelefonu").val($("#nrtelefonu").val().replace(/\s/g, ""));

        $("#form").submit();
    });
    $("#unblock").click(function() {
        $('input:disabled').removeAttr('disabled');
        $('select:disabled').removeAttr('disabled');
    });

});
</script>