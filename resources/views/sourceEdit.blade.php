@extends('layouts.app')

@section('content')
<div class="container">
<form action="/sourceEdit" method="POST">
@csrf
<input type="hidden" name="id" value="{{$data['id']}}">
    <fieldset>
        <legend>Źródło Kontaku</legend>
        <div class="form-group">
        <label for="source">Wpisz źródło kontaktu</label>
        <input type="text" class="form-control w-50" value="{{$data['source']}}" id="source" name="source" aria-describedby="sourceHelp">
        </div>
    </fieldset>
    <fieldset>
        <button type="submit" class="btn btn-primary">Modyfikuj</button>
        <a href="javascript:history.back()" class="btn btn-secondary">Cofnij</a>
    </fieldset>
</form>
</div>
@endsection