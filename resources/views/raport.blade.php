<?php 
    use App\Http\Controllers\RaportController;
?>

@extends('layouts.app')

@section('content')

@include('layouts.raportDate')

<h3 class="mt-3 text-md-center">Raport</h3>


<div class="container">

    <h6><strong>Data Start {{$start}}  -  Data Koniec {{$end}}</strong></h6><br />

    
    <!-- <a href="{{url('export-excel')}}" class="btn btn-primary btn-block">Eksport do Excel</a> -->
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Handlowiec</th>
                <!-- <th scope="col">Adres</th> -->
                <th scope="col">Łącznia w wybrabym okresie</th>
                <!-- <th scope="col">Handlowiec</th> -->
                <th scope="col">Wszytskie Łącznie</th>
                <th scope="col">Spotkania w wybrabym okresie</th>
                <th scope="col">Wszytskie Spotkania</th>


            </tr>
        </thead>
        <tbody>
        <!-- {{ session()->put('massage', collect(request()->segments())->last()) }} -->
            @foreach($user as $item)

                <td>{{$item['name']}}</td>
                <td>{{RaportController::countCallsDate($item->id, $start, $end)}}</td>
                <td>{{RaportController::countCalls($item->id)}}</td>
                <td>{{RaportController::countMeeting($item->id)}}</td>
                <td></td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- <button onclick="location.href='{{ url('addstatus') }}'" class="btn btn-primary float-right">Dodaj status</button> -->
</div>


@endsection

