@extends('layouts.app')


@section('content')
<div class="container">

    <a href="/klient/{{$id_client}}" class="btn btn-success w-25 my-3">Detale rozmowy</a>

    <form action="/spotkanie/edit" method="POST" id="formEdit">
        @csrf
        <input type="hidden" name="id_meet" value="{{$meeting['id']}}">
        <input type="hidden" name="id_user" value="{{$client['handlowiec']}}">
        <input type="hidden" name="id_client" value="{{$meeting['id_client']}}">


        <div class="jumbotron">
            <h1 class="display-5">Dane Spotkania</h1>
            <button type="button" id="unblock" class="btn btn-primary btn-block">Edit</button>
            <a href="/klient/{{$meeting['id_client']}}" class="btn btn-secondary btn-block">Cofnij</a>
            <hr class="my-4">

            @foreach($commets as $commet)
                <h5 class="display-10">{{$commet->commet}} </h5>
                <p><small>{{$commet->created_at}}</small></p>
                <hr class="my-4">

            @endforeach


            <!-- <hr class="my-4"> -->

            <p class="lead"><span style="width:200px; display:inline-block;">Klient</span> 
                <input class="w-50" type="text" name="klient" value="{{$client->nazwa}}" disabled> 
            </p>

            <p class="lead"><span style="width:200px; display:inline-block;">Data Spotkania</span> 
                <input class="w-25" type="date" name="dataspotkania" value="{{$meeting['meet_date']}}" disabled> 
            </p>

            <p class="lead"><span style="width:200px; display:inline-block;">Wielkość Instalacji</span>
                <input class="w-25" type="text" name="wielkoscinstalacji" value="{{$meeting['size_instalation']}}" disabled>
            </p>

            <p class="lead"><span style="width:200px; display:inline-block;">Kierunek Świata</span> 
                <input class="w-25" type="text" name="kierunekswiata" value="{{$meeting['direct_world']}}" disabled>
            </p>

            <p class="lead"><span style="width:200px; display:inline-block;">Typ Umowy</span> 
                <select class="w-25" name="typumowy" id="" disabled>
                    <option value="0" disabled selected>wybierz</option>
                    <option value="1" {{$meeting['type_agreement'] == 1 ? 'selected' : '' }}>Prywatne</option>
                    <option value="2" {{$meeting['type_agreement'] == 2 ? 'selected' : '' }}>Gospodarstwo</option>
                    <option value="3" {{$meeting['type_agreement'] == 3 ? 'selected' : '' }}>Przemysł</option>
                </select>
                <!-- <input class="w-25" type="text" name="typumowy" value=""> -->
            </p>
            <p class="lead"><span style="width:200px; display:inline-block;">Typ Instalacji</span> 
                <select class="w-25" name="typinstalacji" id="" disabled>
                    <option value="0" disabled selected>wybierz</option>
                    <option value="1" {{$meeting['type_installation'] == 1 ? 'selected' : '' }}>Dach Płaski </option>
                    <option value="2" {{$meeting['type_installation'] == 2 ? 'selected' : '' }}>Dach Skośny</option>
                    <option value="3" {{$meeting['type_installation'] == 3 ? 'selected' : '' }}>Grunt</option>
                </select>
                <!-- <input class="w-25" type="text" name="typinstalacji" value=""> -->
            </p>
            <p class="lead"><span style="width:200px; display:inline-block;">Cena</span> 
                <input class="w-25" type="text" name="cena" value="{{$meeting['price_instalation']}}" disabled>
            </p>
            <p class="lead"><span style="width:200px; display:inline-block;">Szansa</span> 
                <select class="w-25" name="szansa" id="" disabled>
                    <option value="0" disabled selected>wybierz</option>
                    <option value="1" {{$meeting['chance_instalation'] == 1 ? 'selected' : '' }}>Mała</option>
                    <option value="2" {{$meeting['chance_instalation'] == 2 ? 'selected' : '' }}>Średnia</option>
                    <option value="3" {{$meeting['chance_instalation'] == 3 ? 'selected' : '' }}>Duża</option>
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