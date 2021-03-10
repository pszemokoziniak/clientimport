@extends('layouts.app')

@section('content')

<div class="container">
<h1 class="display-5">Cennik</h1>

@include('cennikForm')

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Ilość Modułów</th>
                <th scope="col">Firma</th>
                <th scope="col">Moc</th>
                <th scope="col">Dach Płaski</th>
                <th scope="col">Dach Skośny</th>
                <th scope="col">Grunt</th>
            </tr>
        </thead>
        <tbody>

            @foreach($cennik as $item)
            <tr>
                <td>{{$item->ilModulow}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->moc}}</td>
                <td>{{number_format($item->plaski,2,',',' ')}}</td>
                <td>{{number_format($item->skosny,2,',',' ')}}</td>
                <td>{{number_format($item->grunt,2,',',' ')}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>


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


