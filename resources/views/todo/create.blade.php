<?php 
    use App\Http\Controllers\RaportController;
?>

@extends('layouts.app')


@section('content')
<div class="container">

    <form action="form" method="post" id="form">
        @csrf

        <div class="jumbotron">

            @if ($errors->any())
                <div class="alert-danger w-50 lead">Formularz nie zapisany</div>

                @foreach ($errors->all() as $error)
                <div class="alert-danger w-50 lead">{{$error}}</div>
                @endforeach
                <br />
            @endif

            <h1 class="display-5">Wprowadź Zadanie</h1>
            <a href="javascript:history.back()" class="btn btn-secondary btn-block">Cofnij</a>


            <!-- <button type="button" id="unblock" class="btn btn-primary btn-block">Edit</button> -->

            <hr class="my-4">

            <!-- <hr class="my-4"> -->
            <div class="col-md form-group row">
                <div class="col-8">
                    <label for="nazwa" class="lead">Nazwa</label>
                    <input class="w-100 form-control" type="text" id="nazwa" name="nazwa" value="{{ old('nazwa') }}" placeholder="">
                    @error('nazwa')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md form-group">
                <label for="wykonawca" class="lead">Wykonawca</label>                
                    <select class="w-25 form-control" name="wykonawca">
                        <option value="wybierz">wybierz</option>

                        @foreach($users as $user)
                            <option value="{{ old('wykonawca') }}">{{ $user['name'] }}</option>
                        @endforeach
                    </select>
                @error('wykonawca')
                <div class="alert-danger">{{$message}}</div>
                @enderror
            </div>


            <div class="col-md form-group row">
                <div class="col-5">

                    <label for="status" class="lead">Status</label>                
                        <select class="w-50 form-control" name="status">
                            <option value="wybierz">wybierz</option>

                            @foreach($statuses as $item)
                                <option value="{{ $item->id }}" @if ($item->id==1) selected='selected' @endif >{{ $item['status'] }}</option>
                            @endforeach
                        </select>
                    @error('status')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="doKiedy" class="lead">Do kiedy</label>
                    <!-- <i class="fas fa-plus-square fa-2x ml-2 float-right" id="nip_btn" style="color:red; cursor:pointer;"></i> -->
                    <input class="w-40 form-control" type="date" id="doKiedy" name="doKiedy" value="{{ old('doKiedy') }}">
                    @error('doKiedy')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md form-group">
                <div class="col">
                    <label for="opis" class="lead">Opis</label>
                    <textarea class="form-control" name="opis" id="" cols="30" rows="10">{{ old('opis') }}</textarea>
                    @error('opis')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md form-group">
                <label for="zleceniodawca" class="lead">Zleceniodawca</label>
                <select class="w-50 form-control" name="zleceniodawca" disabled readonly>
                    <option value="wybierz">wybierz</option>

                    @foreach($users as $item)
                    <option value="{{ $item->id }}" @if ($item->id===$useradmin->id) selected='selected' @endif>{{ $item['name'] }}</option>
                    @endforeach
                </select>
                @error('zleceniodawca')
                <div class="alert-danger">{{$message}}</div>
                @enderror
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
    // $("#nip_btn").click(function() {
    //     event.preventDefault();
    //     if (#nip)
    //     let nip = parseInt($("#nip").val().replace(/[^0-9]/gi, ''));
    //     const options = {
    //         method: 'post',
    //         url: '/gustest/post',
    //         data: {
    //             nip: nip
    //         }
    //     }
    //     axios(options)
    //     .then(function (response) {
    //     // handle success
    //     $('#nazwa').val(response.data[0]);
    //     $('#miejscowosc').val(response.data[1]);
    //     $('#adresmiasto').val(response.data[2]+' '+response.data[3]+' '+response.data[4]);
    //     $('#kodpocztowy').val(response.data[5]);


    //     console.log(response);
    //     })
    //     .catch(function (error) {
    //         // handle error
    //         console.log(error);
    //     });
    // });



});
</script>