@extends('layouts.app')


@section('content')
<div class="container">


    <form action="/spotkanie" method="post" id="formEdit">
        @csrf
        <input type="hidden" name="id_client" value="{{$id}}">


        <div class="jumbotron">
            <h1 class="display-5">Dane Spotkania</h1>
            <!-- <button type="button" id="unblock" class="btn btn-primary btn-block">Edit</button> -->
            <a href="javascript:history.back()" class="btn btn-secondary btn-block">Cofnij</a>
            <hr class="my-4">

            <hr class="my-4">

            <p class="lead"><span style="width:200px; display:inline-block;">Data Spotkania</span> 
                <input class="w-25" type="date" name="dataspotkania" value=""> 
            </p>

            <p class="lead"><span style="width:200px; display:inline-block;">Wielkość Instalacji</span>
                <input class="w-25" type="text" name="wielkoscinstalacji" value="">
            </p>

            <p class="lead"><span style="width:200px; display:inline-block;">Kierunek Świata</span> 
                <input class="w-25" type="text" name="kierunekswiata" value="">
            </p>

            <p class="lead"><span style="width:200px; display:inline-block;">Typ Umowy</span> 
                <select class="w-25" name="typumowy" id="">
                    <option value="0" disabled selected>wybierz</option>
                    <option value="1">Prywatne</option>
                    <option value="2">Gospodarstwo</option>
                    <option value="3">Przemysł</option>
                </select>
                <!-- <input class="w-25" type="text" name="typumowy" value=""> -->
            </p>
            <p class="lead"><span style="width:200px; display:inline-block;">Typ Instalacji</span> 
                <select class="w-25" name="typinstalacji" id="">
                    <option value="0" disabled selected>wybierz</option>
                    <option value="1">Dach Płaski</option>
                    <option value="2">Dach Skośny</option>
                    <option value="3">Grunt</option>
                </select>
                <!-- <input class="w-25" type="text" name="typinstalacji" value=""> -->
            </p>
            <p class="lead"><span style="width:200px; display:inline-block;">Cena</span> 
                <input class="w-25" type="text" name="cena" value="">
            </p>
            <p class="lead"><span style="width:200px; display:inline-block;">Szansa</span> 
                <select class="w-25" name="szansa" id="">
                    <option value="0" disabled selected>wybierz</option>
                    <option value="1">Mała</option>
                    <option value="2">Średnia</option>
                    <option value="3">Duża</option>
                </select>
            </p>



            <hr class="my-4">

            <div class="form-group">
                <p class="lead">Opis Spotkania</p>
                <textarea class="form-control" name="commentSpotkanie" id="" rows="3"></textarea>
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