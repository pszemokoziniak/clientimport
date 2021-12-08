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
            <a href="javascript:history.back()" class="btn btn-secondary btn-block">Cofnij</a>


            <!-- <button type="button" id="unblock" class="btn btn-primary btn-block">Edit</button> -->

            <hr class="my-4">

            <!-- <hr class="my-4"> -->
            <div class="col-md form-group row">
                <div class="col-5">
                    <label for="nazwa" class="lead">Nazwa</label>
                    <input class="w-100 form-control" type="text" id="nazwa" name="nazwa" value="{{ old('nazwa') }}" placeholder="wymagane">
                    @error('nazwa')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="nip" class="lead">NIP</label><i class="fas fa-plus-square fa-2x ml-2 float-right" id="nip_btn" style="color:red; cursor:pointer;"></i>
                    <input class="w-40 form-control" type="text" id="nip" name="nip" value="{{ old('nip') }}">
                    @error('nip')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md form-group">
                <label for="adresmiasto" class="lead">Adres</label>
                <input class="w-100 form-control" id="adresmiasto" type="text" name="adresmiasto" value="{{ old('adresmiasto') }}">
                @error('adresmiasto')
                <div class="alert-danger">{{$message}}</div>
                @enderror
            </div>


            <div class="col-md form-group row">
                <div class="col">
                    <label for="miejscowosc" class="lead">Miejscowość</label>
                    <input class="w-100 form-control" type="text" id="miejscowosc" name="miejscowosc" value="{{ old('miejscowosc') }}">
                    @error('miejscowosc')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="col">
                    <label for="kodpocztowy" class="lead">Kod Pocztowy</label>
                    <input class="w-50 form-control" type="text" id="kodpocztowy" name="kodpocztowy" value="{{ old('kodpocztowy') }}">
                    @error('kodpocztowy')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md form-group row">
                <div class="col">
                    <label for="nrtelefonu" class="lead">Numer Tel.</label>
                    <input class="w-75 form-control" type="text" name="nrtelefonu" id="nrtelefonu" value="{{ old('email') }}" placeholder="wymagane">
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

            <div class="col-md form-group row">
                <div class="col">
                    <label for="osobakontaktowa" class="lead">Osoba kontaktowa</label>
                    <input id="osobakontaktowa" class="w-75 form-control" type="text" name="osobakontaktowa" value="{{ old('osobakontaktowa') }}">
                        @error('osobakontaktowa')
                        <div class="alert-danger w-75">{{$message}}</div>
                        @enderror
                </div>
            </div>


            <div class="col-md form-group row">
                <div class="col">
                    <label for="hanlowiec" class="lead">Handlowiec</label>
                    <select class="w-50 form-control" name="handlowiec">
                        <option value="wybierz">wybierz</option>

                        @foreach($users as $user)
                        <option value="{{ $user['id'] }}" {{ (old("handlowiec") == $user['id'] ? "selected":"") }}>{{ $user['name'] }}</option>
                        <!-- <option value="{{$user['id']}}">
                            {{$user['name']}}</option> -->
                        @endforeach
                    </select>
                    @error('handlowiec')
                    <div class="alert-danger w-50">{{$message}}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="statusSource" class="lead">Źródło klienta</label>
                    <select class="w-50 form-control" name="statusSource">
                        <option value="wybierz">wybierz</option>
                        @foreach($sourceclients as $sourceclient)
                        <option value="{{ $sourceclient['id'] }}" {{ (old("statusSource") == $sourceclient['id'] ? "selected":"") }}>{{ $sourceclient['source'] }}</option>
                        <!-- <option value="{{$sourceclient['id']}}">
                            {{$sourceclient['source']}}
                        </option> -->
                        @endforeach
                    </select>
                    @error('statusSource')
                    <div class="alert-danger w-50">{{$message}}</div>
                    @enderror
                </div>

            </div>
            <div class="col-md form-group row">
                <div class="col">
                    <label for="kampania" class="lead">Kampania</label>
                        <select class="w-100 form-control" name="kampania">
                            <option value="wybierz">wybierz</option>
                            @foreach($pradkampania as $item)
                                <option value="{{ $item['id'] }}" {{ (old("kampania") == $item['id'] ? "selected":"") }}>{{ $item['kampania'] }}</option>
                                <!-- <option value="{{$item['id']}}">
                                    {{$item['kampania']}}
                                </option> -->
                            @endforeach
                        </select>
                        @error('kampania')
                        <div class="alert-danger w-100">{{$message}}</div>
                        @enderror
                </div>
                <div class="col">
                    <label for="branza" class="lead">Branża</label>
                        <select class="w-100 form-control" name="branza">
                            <option value="wybierz">wybierz</option>
                            @foreach($clientbranza as $item)
                                <option value="{{ $item['id'] }}" {{ (old("branza") == $item['id'] ? "selected":"") }}>{{ $item['branza'] }}</option>
                                <!-- <option value="{{$item['id']}}">
                                    {{$item['kampania']}}
                                </option> -->
                            @endforeach
                        </select>
                        @error('branza')
                        <div class="alert-danger w-100">{{$message}}</div>
                        @enderror
                </div>

            </div>


            <!-- <hr class="my-4"> -->

            <!-- <div class="form-group">
                <p class="lead">Dodaj Komentarz</p>
                <textarea class="form-control" name="comment" id="" rows="3"></textarea>
            </div> -->
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
        $("#form").submit();
    });


    $("#nrtelefonu").change(function() {
        $("#nrtelefonu").val($("#nrtelefonu").val().replace(/\s/g, ""));
    });
    $("#nip_btn").click(function() {
        event.preventDefault();
        const nip = $("#nip").val();
        const options = {
            method: 'post',
            url: '/gustest/post',
            data: {
                nip: nip
            }
        }
        axios(options)
        .then(function (response) {
        // handle success
        $('#nazwa').val(response.data[0]);
        $('#miejscowosc').val(response.data[1]);
        $('#adresmiasto').val(response.data[2]+' '+response.data[3]+' '+response.data[4]);
        $('#kodpocztowy').val(response.data[5]);


        console.log(response);
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
    });



});
</script>