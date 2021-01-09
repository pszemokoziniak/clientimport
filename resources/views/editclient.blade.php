@extends('layouts.app')


@section('content')
<div class="container">
    <form action="/editclient" method="post" id="formEdit">
        @csrf
        <input type="hidden" name="id" value="{{$data['id']}}">


        <div class="jumbotron">
            <h1 class="display-5">Dane Klienta</h1>
            <button type="button" id="unblock" class="btn btn-primary btn-block">Edit</button>
            <a href="javascript:history.back()" class="btn btn-secondary btn-block">Cofnij</a>
            <hr class="my-4">
                @foreach($comments as $comment)
                    <h5 class="display-10">{{$comment->comment}} {{$comment->created_at}}</h5>
                @endforeach
            
            <hr class="my-4">
            <p class="lead"><span style="width:150px; display:inline-block;">Nazwa</span> <input class="w-75"
                    type="text" name="nazwa" value="{{$data['nazwa']}}" disabled></p>
            <p class="lead"><span style="width:150px; display:inline-block;">Adres</span> <input class="w-50"
                    type="text" disabled name="adresmiasto" value="{{$data['adresmiasto']}}" disabled> <input
                    type="text" name="kodpocztowy" value="{{$data['kodpocztowy']}}" disabled></p>
            <p class="lead"><span style="width:150px; display:inline-block;">Numer Tel.</span> <input type="text"
                    name="nrtelefonu" value="{{$data['nrtelefonu']}}" disabled>
                Status <select name="status" disabled>
                    @foreach($statuses as $status)
                    <option value="{{$status['id']}}" {{$data->status == $status->id ? 'selected' : '' }}>
                        {{$status['status']}}</option>
                    @endforeach
                </select>
                Data Kontaktu <input type="date" name="kontakt_data" value="{{$data['kontakt_data']}}" disabled>
            </p>
            <p class="lead"><span style="width:150px; display:inline-block;">Handlowiec</span> <input type="text"
                    name="handlowiec" value="{{$data['handlowiec']}}" disabled></p>
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