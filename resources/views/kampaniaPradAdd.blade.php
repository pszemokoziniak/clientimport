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

    <form action="kampaniaPradAdd" method="POST">
    @csrf
        <fieldset>
            <legend>Kampania Prąd</legend>
            <div class="form-group">
                <label for="kampania">Kampania</label>
                <input type="text" class="form-control w-50" id="kampania" name="kampania" aria-describedby="statusHelp" placeholder="wymagane">
                @error('kampania')
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