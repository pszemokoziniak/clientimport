@extends('layouts.app')

@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert-danger w-50 lead">Formularz nie zapisany</div>

    @foreach ($errors->all() as $error)
    <div class="alert-danger w-50 lead">{{$error}}</div>
    @endforeach
    <br />
@endif

<form action="statusAdd" method="POST">
@csrf
    <fieldset>
        <legend>Status Kontaku</legend>
        <div class="form-group">
        <label for="status">Status</label>
        <input type="text" class="form-control w-50" id="status" name="status" aria-describedby="statusHelp" placeholder="status">
        @error('status')
            <div class="alert-danger w-50">{{$message}}</div>
        @enderror

        <hr>
        <label for="status">Aktywny</label>
        <select class="form-select" name="aktywny" id="">
            <option value="wybierz">wybierz</option>
            <option value="1">Tak</option>
            <option value="2">Nie</option>
        </select>
        @error('aktywny')
            <div class="alert-danger w-50">{{$message}}</div>
        @enderror
        </div>
    </fieldset>
        <button type="submit" class="btn btn-primary">Zapisz</button>
        <a href="javascript:history.back()" class="btn btn-secondary">Cofnij</a>
    </fieldset>
</form>
</div>
@endsection