@extends('layouts.app')


@section('content')

<form action="/kalkulator" method="post" id="form">
        @csrf
        <div class="jumbotron">
        <input type="hidden" value="{{ request()->route('id') }}" name="id_client">
        <div class="col-md form-group row">

            <div class="col">
                <label for="rachunek" class="lead">Rachunek Kwota</label>
                <input id="rachunek" class="w-50 form-control test" type="text" name="rachunek" value="{{ old('rachunek') }}">
                    @error('rachunek')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
            </div>

            <div class="col">
                <label for="cykl" class="lead">Cykl rachunku</label>
                <input id="cykl" class="w-50 form-control test" type="text" name="cykl" value="2">
                    @error('cykl')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
            </div>
        </div>

        <div class="col-md form-group row">
            <div class="col">
                <label for="zuzycie" class="lead">Miesięczne zużycie kWh</label>
                <input id="zuzycie" class="w-50 form-control" type="text" name="zuzycie" value="{{ old('zuzycie') }}">
                    @error('zuzycie')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
            </div>

            <div class="col">
                <label for="dach" class="lead">Rodzaj dachu</label>
                <select class="w-50 form-control" name="dach">
                    <option value="">wybierz</option>
                    <option value="1">Płaski</option>
                    <option value="2">Skośny</option>
                    <option value="3">Grunt</option>
                </select>
                    @error('dach')
                    <div class="alert-danger w-50">{{$message}}</div>
                    @enderror
            </div>
        </div>



            <div class="col-md form-group row">
                <div class="col">
                    <label for="zuzycieroczne" class="lead">Zużycie Roczne MWH</label>
                    <input id="zuzycieroczne" class="w-50 form-control" type="text" name="zuzycieroczne" value="{{ old('zuzycieroczne') }}">
                        @error('zuzycieroczne')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                </div>

                <div class="col">
                    <label for="moc" class="lead">Moc instalacji opcjonalna</label>
                    <input id="moc" class="w-50 form-control" type="text" name="moc" value="{{ old('moc') }}">
                        @error('moc')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                </div>
            </div>

            <div class="col-md form-group row">
                <div class="col">
                    <label for="oszczednosc" class="lead">Oszczędność Roczna</label>
                    <input id="oszczednosc" class="w-50 form-control" type="text" name="oszczednosc" value="{{ old('oszczednosc') }}">
                        @error('oszczednosc')
                        <div class="alert-danger w-50">{{$message}}</div>
                        @enderror
                </div>

                <div class="col">
                    <label for="mocmodulow" class="lead">Moc modułów</label>
                    <select id="mocmodulow" class="w-50 form-control" name="mocmodulow">
                        <option>0.275</option>
                        <option>0.285</option>
                        <option>0.31</option>
                        <option selected>0.33</option>
                    </select>

                        @error('mocmodulow')
                        <div class="alert-danger w-50">{{$message}}</div>
                        @enderror
                </div>
            </div>

            <div class="col-md form-group">
                    <label for="iloscmodulow" class="lead">Ilość modułów</label>
                    <input id="iloscmodulow" class="w-25 form-control" type="text" name="iloscmodulow" value="{{ old('iloscmodulow') }}">
                        @error('iloscmodulow')
                        <div class="alert-danger w-25">{{$message}}</div>
                        @enderror
            </div>


            <div class="col-md form-group row">
                <div class="col">
                    <label for="minpowskosny" class="lead">Min. potrzebna pow. skośnego</label>
                    <input id="minpowskosny" class="w-50 form-control" type="text" name="minpowskosny" value="{{ old('minpowskosny') }}">
                        @error('minpowskosny')
                        <div class="alert-danger w-50">{{$message}}</div>
                        @enderror
                </div>

                <div class="col">
                    <label for="minpowgrunt" class="lead">Min. potrzebna pow. płaskiego</label>
                    <input id="minpowgrunt" class="w-50 form-control" type="text" name="minpowgrunt" value="{{ old('minpowgrunt') }}">
                        @error('minpowgrunt')
                        <div class="alert-danger w-50">{{$message}}</div>
                        @enderror
                </div>
            </div>

            <button type="submit" id="save" class="btn btn-success btn-block">Zapisz</button>
        </div>
</form>
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {


    $(".test").keyup(function() {
        $("#zuzycie").val( ($("#rachunek").val()/$("#cykl").val()/0.7).toFixed(2) );
        $("#zuzycieroczne").val( ($("#zuzycie").val()*12/1000).toFixed(2) );
        $("#moc").val( ($("#zuzycieroczne").val()*1.25).toFixed(2) );
        $("#oszczednosc").val( ($("#zuzycie").val()*0.7*12*0.8).toFixed(0) );
        $("#iloscmodulow").val( ($("#moc").val()/$("#mocmodulow").val()).toFixed(0) );
        $("#minpowskosny").val( ($("#iloscmodulow").val()*1.7).toFixed(2) );
        $("#minpowgrunt").val( ($("#minpowskosny").val()*1.5).toFixed(2) );

    });



});
</script>


