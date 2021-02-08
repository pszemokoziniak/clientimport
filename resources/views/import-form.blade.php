@extends('layouts.app')


@section('content')
    <section style="padding-top:60px">

        <div class="container">
        <a href="javascript:history.back()" class="btn btn-secondary btn-block my-3">Cofnij</a>
        

            <div class="row">
                <dic class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            Import
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="{{route('client.import')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="file">Wybierz Plik</label>
                                    <input type="file" name="file" class="form-control" >
                                </div>
                                <button type="submit" class="btn btn-primary">Zapisz</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection