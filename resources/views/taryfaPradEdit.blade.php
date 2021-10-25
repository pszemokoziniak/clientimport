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

    <form action="/taryfaPradEdit" method="POST">
    @csrf
        <input type="hidden" name="id" value="{{$data['id']}}">
        <fieldset>
            <legend>Taryfa Prądu</legend>
            <div class="form-group">
            <label for="taryfa">Taryfa</label>
            <input type="text" class="form-control w-50" value="{{$data['taryfa']}}" id="taryfa" name="taryfa" aria-describedby="statusHelp" placeholder="wymagane">
            @error('taryfa')
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