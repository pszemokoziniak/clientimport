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

    <a type="button" class="btn btn-success w-25 my-3" href={{"/klientKalulator"}}>Kalkulator</a>


    <form action="/klient" method="post" id="form">
        @csrf
        <input type="hidden" name="id" value="{{$data['id']}}">


        <div class="jumbotron">

            @if ($errors->any())
                <div class="alert-danger w-50 lead">Formularz nie zapisany</div>

                @foreach ($errors->all() as $error)
                <div class="alert-danger w-50 lead">{{$error}}</div>
                @endforeach
                <br />
            @endif


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
            
            <div class="col-md form-group row">
                <div class="col">
                    <label for="nazwa" class="lead">Nazwa</label>
                    <input class="w-100 form-control" type="text" name="nazwa" value="{{$data['nazwa']}}" disabled>
                        @error('nazwa')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                </div>
                <div class="col">
                    <label for="nip" class="lead">NIP</label>
                    <input class="w-50 form-control" type="text" name="nip" value="{{$data['nip']}}" disabled>
                        @error('nip')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                </div>
            </div>

            <div class="col-md form-group">
                <label for="adresmiasto" class="lead">Adres</label>
                <input class="w-75 form-control" type="text" name="adresmiasto" value="{{$data['adresmiasto']}}" disabled>
                    @error('adresmiasto')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
            </div>


            <div class="col-md form-group row">
                <div class="col">
                    <label for="miejscowosc" class="lead">Miejscowość</label>
                    <input class="w-100 form-control" type="text" name="miejscowosc" value="{{$data['miejscowosc']}}" disabled>
                        @error('miejscowosc')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                </div>

                <div class="col">
                    <label for="kodpocztowy" class="lead">Kod Pocztowy</label>
                    <input class="w-50 form-control" type="text" name="kodpocztowy" value="{{$data['kodpocztowy']}}" disabled>
                        @error('kodpocztowy')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                </div>
            </div>

            <div class="col-md form-group row">
                <div class="col">
                    <label for="nrtelefonu" class="lead">Numer Tel.</label>
                    <input id="nrtelefonu" class="w-75 form-control" type="text" name="nrtelefonu" value="{{phone($data['nrtelefonu'], 'PL')->formatNational()}}" disabled>
                        @error('nrtelefonu')
                        <div class="alert-danger w-75">{{$message}}</div>
                        @enderror
                </div>

                <div class="col">
                    <label for="email" class="lead">Email</label>
                    <input class="w-75 form-control" type="text" name="email" value="{{$data['email']}}" disabled>
                        @error('email')
                        <div class="alert-danger w-75">{{$message}}</div>
                        @enderror
                </div>
            </div>

            <div class="col-md form-group row">
                <div class="col">
                    <label for="status" class="lead">Status</label>
                    <select class="w-75 form-control" name="status" disabled>
                        @foreach($statuses as $status)
                        <option value="{{$status['id']}}" {{$data->status == $status->id ? 'selected' : '' }}>
                            {{$status['status']}}
                        </option>
                        @endforeach
                    </select>
                    @error('status')
                    <div class="alert-danger w-25">{{$message}}</div>
                    @enderror
                </div>

                <div class="col">
                    <label for="kontakt_data" class="lead">Data Kontaktu</label>
                    <input class="w-50 form-control" type="date" name="kontakt_data" value="{{$data['kontakt_data']}}" disabled>
                        @error('kontakt_data')
                        <div class="alert-danger w-50">{{$message}}</div>
                        @enderror
                </div>

                <div class="col">
                    <label for="kontakt_data" class="lead">Godzina Kontaktu</label>
                    <input class="w-50 form-control" type="time" name="kontakt_godzina" value="{{$data['kontakt_godzina']}}" disabled>
                        @error('kontakt_godzina')
                        <div class="alert-danger w-50">{{$message}}</div>
                        @enderror
                </div>

            </div>

            <div class="col-md form-group">
                <label for="hanlowiec" class="lead">Handlowiec</label>
                <select class="w-25 form-control" name="handlowiec" disabled>
                    @foreach($users as $user)
                        <option value="{{$user['id']}}" {{$data->handlowiec == $user->id ? 'selected' : '' }}>
                            {{$user['name']}}
                        </option>
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

        const trim = async () => {
            $("#nrtelefonu").val($("#nrtelefonu").val().replace(/\s/g, ""));
        }

        const save = async () => {
            const saveend = await trim ()
            await $("#form").submit();
        }

        save();

    });



    $("#unblock").click(function() {
        $('input:disabled').removeAttr('disabled');
        $('select:disabled').removeAttr('disabled');
    });

});

</script>