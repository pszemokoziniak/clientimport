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

    <form action="/ClientBranzaEdit" method="POST">
    @csrf
        <input type="hidden" name="id" value="{{$data['id']}}">
        <fieldset>
            <legend>Branża klient</legend>
            <div class="form-group">
            <label for="branza">Branza</label>
            <input type="text" class="form-control w-50" value="{{$data['branza']}}" id="branza" name="branza" aria-describedby="statusHelp" placeholder="wymagane">
            @error('branza')
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