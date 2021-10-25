@extends('layouts.app')

@section('content')
<div class="container">
<form action="sourceAdd" method="POST">
@csrf
    <fieldset>
        <legend>Źródło kontaktu</legend>
        <div class="form-group">
        <label for="source">Dodaj źródło</label>
        <input type="text" class="form-control w-50" id="source" name="source" aria-describedby="sourceHelp" placeholder="wpisz źródło kontaktu">
        </div>
    </fieldset>
    <fieldset>
        <button type="submit" class="btn btn-primary">Zapisz</button>
        <a href="javascript:history.back()" class="btn btn-secondary">Cofnij</a>
    </fieldset>
</form>
</div>
@endsection