<?php 
    use App\Http\Controllers\RaportController;
?>

@extends('layouts.app')


@section('content')
<div class="container">

    <form action="/ftpback" method="post" enctype="multipart/form-data">
    @csrf
        <div class="jumbotron">
        <h3>Detale Umowy</h3>
        <hr>
            <div class="row row-cols-4 text-center text-lg font-weight-bold">
                <div class="col">Klient</div>
                <div class="col">Dostawca</div>
                <div class="col">Taryfa</div>
                <div class="col">Dystrybucja</div>  
            </div>
            <div class="row row-cols-4 text-center">
                @foreach ($data as $item)
                    <div class="col">{{$item->nazwa}}</div>
                    <div class="col">{{$item->firmadostawca}}</div>
                    <div class="col">{{$item->taryfa}}</div>
                    <div class="col">{{$item->dystrybucja}}</div>
                @endforeach
            </div>
            <hr>
            <div class="row row-cols-4 text-center text-lg font-weight-bold">
                <div class="col">Okres Umowy</div>
                <div class="col">Wolumen</div>
                <div class="col">Cena Klienta</div>
            </div>

            <div class="row row-cols-4 text-center">
                <div class="col">{{$item->start}} - {{$item->end}}</div>
                <div class="col">{{$item->volumen}}</div>
                <div class="col">{{$item->cenaklient}}</div>
            </div>
            <hr>

                @if ($errors->any())
                    <div class="alert-danger w-50 lead">Formularz nie zapisany</div>

                    @foreach ($errors->all() as $error)
                    <div class="alert-danger w-50 lead">{{$error}}</div>
                    @endforeach
                    <br />
                @endif
                <div class="row">
                <dic class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            Import
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="{{route('file.export')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="file">Wybierz Plik</label>
                                    <input type="file" name="profile_image" id="exampleInputFile" multiple class="form-control"/>
                                    <input type="hidden" name="id_umowa" id="id_umowa" value="{{$item->id}}">
                                    <input type="hidden" name="id_client" id="id_umowa" value="{{$item->id_client}}">

                                    <!-- <input type="file" name="file" class="form-control" > -->
                                </div>
                                <button type="submit" class="btn btn-primary">Zapisz</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

                <!-- <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" name="profile_image" id="exampleInputFile" multiple />
                </div>
                <button type="submit" class="btn btn-default">Submit</button> -->
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