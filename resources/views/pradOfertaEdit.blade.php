<?php 
    use App\Http\Controllers\RaportController;
?>

@extends('layouts.app')


@section('content')
<div class="container">

<form action="/pradOfertaUpdate" method="post" id="form_prad">
    <input type="hidden" name="id" value="{{$dataprad['id']}}">
    <input type="hidden" name="id_client" value="{{$dataprad['id_client']}}">

        @csrf
        <!-- <div class="border_client" id=""> -->
    
            @if ($errors->any())
                <div class="alert-danger w-50 lead">Formularz nie zapisany</div>

                @foreach ($errors->all() as $error)
                <div class="alert-danger w-50 lead">{{$error}}</div>
                @endforeach
                <br />
            @endif

            <h1 class="display-5">Oferta Prąd</h1>
            <button type="button" id="unblock" class="btn btn-primary btn-block">Edit</button>
            <a href="javascript:history.back()" class="btn btn-secondary btn-block">Cofnij</a>

            <hr class="my-4">
            
            <div class="col-md form-group row">
                <div class="col">
                    <label for="firmadostawca" class="lead">Firma Dostawca</label>
                    <select class="w-50 form-control" name="firmadostawca" disabled>
                        <option value="wybierz">wybierz</option>
                        @foreach($dostawcaprad as $item)
                        <option value="{{$item['id']}}" {{$item->id == $dataprad['firmadostawca'] ? 'selected' : '' }}>
                            {{$item['firmadostawca']}}
                        </option>
                        @endforeach
                    </select>
                    @error('firmadostawca')
                        <div class="alert-danger w-50">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md form-group row">
                <div class="col">
                    <label for="taryfa" class="lead">Taryfa</label>
                    <select class="w-100 form-control" name="taryfa" disabled>
                    <option value="wybierz">wybierz</option>
                        @foreach($pradtaryfa as $item)
                            <option value="{{$item['id']}}" {{$item->id == $dataprad['taryfa'] ? 'selected' : '' }}>
                                {{$item['taryfa']}}
                            </option>
                        @endforeach
                    </select>
                    @error('taryfa')
                    <div class="alert-danger w-100">{{$message}}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="cennik" class="lead">Cennik</label>
                    <input class="w-100 form-control" type="text" name="cennik" value="{{$dataprad['cennik']}}" disabled>
                        @error('cennik')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                </div>
                <div class="col">
                    <label for="volumen" class="lead">Wolumen</label>
                    <input class="w-100 form-control" type="text" name="volumen" value="{{$dataprad['volumen']}}" disabled>
                        @error('volumen')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                </div>
            </div>


            <div class="col-md form-group row">
                <div class="col">
                    <label for="ppe" class="lead">Liczba PPE</label>
                    <input class="w-100 form-control" type="text" name="ppe" value="{{$dataprad['ppe']}}" disabled>
                        @error('ppe')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                </div>

                <div class="col">
                    <label for="terendystrybucja" class="lead">Teren Dystrybucji</label>
                        <select class="w-100 form-control" name="terendystrybucja" disabled>
                            <option value="wybierz">wybierz</option>
                            @foreach($praddystrybucja as $item)
                                <option value="{{$item['id']}}" {{$item->id == $dataprad['terendystrybucja'] ? 'selected' : '' }}>
                                    {{$item['dystrybucja']}}
                                </option>
                            @endforeach
                        </select>
                        @error('terendystrybucja')
                        <div class="alert-danger w-100">{{$message}}</div>
                        @enderror
                </div>
            </div>

            <div class="col-md form-group row">
                <div class="col">
                    <label for="start" class="lead">Start Umowy</label>
                    <input class="w-50 form-control" type="date" name="start" value="{{$dataprad['start']}}" disabled>
                        @error('start')
                        <div class="alert-danger w-50">{{$message}}</div>
                        @enderror
                </div>

                <div class="col">
                    <label for="end" class="lead">Koniec Umowy</label>
                    <input class="w-50 form-control" type="date" name="end" value="{{$dataprad['end']}}" disabled>
                        @error('end')
                        <div class="alert-danger w-50">{{$message}}</div>
                        @enderror
                </div>
                <div class="col">
                    <label for="cenaklient" class="lead">Cena</label>
                    <input class="w-100 form-control" type="text" name="cenaklient" value="{{$dataprad['cenaklient']}}" disabled>
                        @error('cenaklient')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                </div>

            </div>

            <div class="col-md form-group row">
                <div class="col">
                    <label for="kampania" class="lead">Kampania</label>
                        <select class="w-100 form-control" name="kampania" disabled>
                            <option value="wybierz">wybierz</option>
                            @foreach($pradkampania as $item)
                            <option value="{{$item['id']}}" {{$item->id == $dataprad['kampania'] ? 'selected' : '' }}>
                                    {{$item['kampania']}}
                                </option>
                            @endforeach
                        </select>
                        @error('kampania')
                        <div class="alert-danger w-100">{{$message}}</div>
                        @enderror
                </div>

                <div class="col">
                    <label for="statusoferta" class="lead">Status</label>
                        <select class="w-100 form-control" name="statusoferta" disabled>
                            <option value="wybierz">wybierz</option>
                            @foreach($pradstatusoferta as $item)
                            <option value="{{$item['id']}}" {{$item->id == $dataprad['status'] ? 'selected' : '' }}>
                                {{$item['statusoferta']}}
                            </option>
                            @endforeach
                        </select>
                        @error('statusoferta')
                        <div class="alert-danger w-100">{{$message}}</div>
                        @enderror
                </div>
            </div>
        <!-- </div> -->
        <hr>

        <!-- <div class="form-group">
                <p class="lead">Dodaj Komentarz</p>
                <textarea class="form-control" name="comment" id="" rows="3"></textarea>
        </div> -->
            <!-- <button type="button" id="save" class="btn btn-success btn-block">Zapisz</button> -->
            <button type="button" id="save_prad" class="btn btn-success btn-block">Zapisz</button>

        </div>


        </form>
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $("#save_prad").click(function() {
        event.preventDefault();
        $('input:disabled').removeAttr('disabled');
        $('select:disabled').removeAttr('disabled');
        // $("#nrtelefonu").val($("#nrtelefonu").val().replace(/\s/g, ""));

        $("#form_prad").submit();
    });
    $("#unblock").click(function() {
        $('input:disabled').removeAttr('disabled');
        $('select:disabled').removeAttr('disabled');
    });

});
</script>