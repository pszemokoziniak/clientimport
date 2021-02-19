@extends('layouts.app')

@section('content')

@include('layouts.raportDate')

<h3 class="mt-3 text-md-center">Raport</h3>


<div class="container">

    <h6><strong>Data Start {{$start}}  -  Data Koniec {{$end}}</strong></h6><br />

    @include('raportCalls')

    @include('raportMeets')

</div>


@endsection

