@extends('layouts.app')

@section('content')
<div class="container">
<form action="/editstatus" method="POST">
@csrf
<input type="hidden" name="id" value="{{$data['id']}}">
    <fieldset>
        <legend>Status Kontaku</legend>
        <div class="form-group">
        <label for="status">Status</label>
        <input type="text" class="form-control w-50" value="{{$data['status']}}" id="status" name="status" aria-describedby="statusHelp" placeholder="status">
        </div>
    </fieldset>
        <button type="submit" class="btn btn-primary">Modyfikuj</button>
        <a href="javascript:history.back()" class="btn btn-secondary">Cofnij</a>
    </fieldset>
</form>
</div>
@endsection