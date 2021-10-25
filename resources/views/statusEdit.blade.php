@extends('layouts.app')

@section('content')
<div class="container">
<form action="/statusEdit" method="POST">
@csrf
<input type="hidden" name="id" value="{{$data['id']}}">

    <fieldset>
        <legend>Status Kontaku</legend>
        <div class="form-group">
        <label for="status">Status</label>
        <input type="text" class="form-control w-50" value="{{$data['status']}}" id="status" name="status" aria-describedby="statusHelp" placeholder="status">
        @error('status')
            <div class="alert-danger w-50">{{$message}}</div>
        @enderror
        <hr>
        <label for="status">Aktywny</label>
        <select class="form-select" name="aktywny" id="">
            <option value="1" {{$data->aktywny == 1 ? 'selected' : '' }}>Tak</option>
            <option value="2" {{$data->aktywny == 2 ? 'selected' : '' }}>Nie</option>
        </select>
        @error('aktywny')
            <div class="alert-danger w-50">{{$message}}</div>
        @enderror

        </div>
    </fieldset>
        <button type="submit" class="btn btn-primary">Modyfikuj</button>
        <a href="javascript:history.back()" class="btn btn-secondary">Cofnij</a>
    </fieldset>
</form>
</div>
@endsection