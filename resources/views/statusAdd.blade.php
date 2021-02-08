@extends('layouts.app')

@section('content')
<div class="container">
<form action="statusAdd" method="POST">
@csrf
    <fieldset>
        <legend>Status Kontaku</legend>
        <div class="form-group">
        <label for="status">Status</label>
        <input type="text" class="form-control w-50" id="status" name="status" aria-describedby="statusHelp" placeholder="status">
        </div>
    </fieldset>
        <button type="submit" class="btn btn-primary">Zapisz</button>
        <a href="javascript:history.back()" class="btn btn-secondary">Cofnij</a>
    </fieldset>
</form>
</div>
@endsection