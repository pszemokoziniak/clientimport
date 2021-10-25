@extends('layouts.app')


@section('content')

<div class="container">
    <hr>
    <h1>OFERTA</h1>
        @if ($errors->any())
            <div class="alert-danger w-50 lead">Formularz nie wysłany<br/>Nie wszystkie pola są wypełnione</div>

            <!-- @foreach ($errors->all() as $error)
            <div class="alert-danger w-50 lead">{{$error}}</div>
            @endforeach
            <br /> -->
        @endif

    <hr>
        <h3>Klient: {{$client['nazwa']}}  <a href="{{ URL::to('klient/' . $client->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
  <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
</svg></a><br /> Telefon: {{$client['nrtelefonu']}}<br /> Email: {{$client['email']}}</h3>

        <h4>Dach {{$dachNazwaPol}} - moc: {{$mocKalkulatorStart}} - {{$mocKalkulatorEnd}} kWp</h4>
        <h5>Potrzebna Moc: {{$kalkulator->moc}}</h5>
        <table class="table table-hover" id="Table1">
        <thead>
            <tr>
                <th scope="col">Wybierz</th>
                <th scope="col">Ilość Moddułów</th>
                <th scope="col">Firma</th>
                <th scope="col">Moc</th>
                <th scope="col">Cenno Netto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($oferta as $item)
                <tr>
                    <td><input type="checkbox"/></td>
                    <td>{{$item->ilModulow}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->moc}}</td>
                    <td>{{number_format($item->dach,2,',',' ')}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <input id = "btnGet" class="btn btn-primary" type="button" value="Wybierz" />

    <hr>

    <form action="/oferta" method="post" id="form">
        @csrf
        <div class="jumbotron">

            <input type="hidden" value="{{ request()->route('id') }}" name="id_client">

                <div class="col-md form-group row">

                    <div class="col">
                        <label for="firma" class="lead">Firma</label>
                        <input id="firma" class="w-100 form-control test" type="text" name="firma" value="{{ old('firma') }}">
                            @error('firma')
                            <div class="alert-danger w-100">{{$message}}</div>
                            @enderror
                    </div>

                    <div class="col">
                        <label for="cena" class="lead">Cena Netto</label>
                        <input id="cena" class="w-75 form-control" type="text" name="cena" value="{{ old('cena') }}">
                            @error('cena')
                            <div class="alert-danger w-75">{{$message}}</div>
                            @enderror
                    </div>

                </div>

                <div class="col-md form-group row">

                    <div class="col">
                        <label for="iloscModulow" class="lead">Ilość Modułów</label>
                        <input id="iloscModulow" class="w-50 form-control test" type="text" name="iloscModulow" value="{{ old('iloscModulow') }}">
                            @error('iloscModulow')
                            <div class="alert-danger w-50">{{$message}}</div>
                            @enderror
                    </div>

                    <div class="col">
                        <label for="moc" class="lead">Moc</label>
                        <input id="moc" class="w-50 form-control" type="text" name="moc" value="{{ old('moc') }}">
                            @error('moc')
                            <div class="alert-danger w-50">{{$message}}</div>
                            @enderror
                    </div>

                    <div class="col">
                        <label for="dach" class="lead">Typ Dachu</label>
                        <input id="dach" class="w-50 form-control" type="text" name="dach" value="{{$dachNazwaPol}}">
                            @error('dach')
                            <div class="alert-danger w-50">{{$message}}</div>
                            @enderror
                    </div>

                </div>

                <div class="col-md form-group row">

                    <div class="col">
                        <label for="cenaNetto" class="lead">Cena Netto</label>
                        <input id="cenaNetto" class="w-50 form-control test" type="text" name="cenaNetto" value="{{ old('cenaNetto') }}">
                            @error('cenaNetto')
                            <div class="alert-danger w-50">{{$message}}</div>
                            @enderror
                    </div>

                    <div class="col">
                        <label for="vat" class="lead">Vat</label>
                        <select class="w-50 form-control wymagane" name="vat" id="vat">
                            <option slected>wybierz</option>
                            <option value="0.08">0.08</option>
                            <option value="0.23">0.23</option>
                        </select>
                            @error('vat')
                            <div class="alert-danger w-50">{{$message}}</div>
                            @enderror
                    </div>

                    <div class="col">
                        <label for="cenaBrutto" class="lead">Cenna Brutto</label>
                        <input id="cenaBrutto" class="w-50 form-control" type="text" name="cenaBrutto" value="{{ old('cenaBrutto') }}">
                            @error('cenaBrutto')
                            <div class="alert-danger w-50">{{$message}}</div>
                            @enderror
                    </div>

                </div>

                <div class="col-md form-group row">
                    <div class="col">
                        <label for="email" class="lead">Email</label>
                        <input id="email" class="w-50 form-control" type="text" name="email" value="{{$client['email']}}">
                            @error('email')
                            <div class="alert-danger w-50">{{$message}}</div>
                            @enderror
                    </div>
                </div>

                <button type="submit" id="save" class="btn btn-success btn-block">Zapisz Ofertę</button>
        </div>
    </form>


</div>

@endsection

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
    $(function () {
        //Assign Click event to Button.
        $("#btnGet").click(function () {
            // var message = "Id Name                  Country\n";
 
            //Loop through all checked CheckBoxes in GridView.
            $("#Table1 input[type=checkbox]:checked").each(function () {
                var row = $(this).closest("tr")[0];
                var firma = row.cells[2].innerHTML.replace(/&amp;/g, '&');
                $("#iloscModulow").val(row.cells[1].innerHTML);
                $("#firma").val(firma);
                $("#moc").val(row.cells[3].innerHTML);
                $("#cena").val(row.cells[4].innerHTML);
            });
 
            return false;
        });
    });
    $(document).ready(function() {
        $( "#vat" ).change(function() {
            // alert($("#cenaNetto").val());
            $("#cenaBrutto").val( parseInt($("#cenaNetto").val()) + (parseInt($("#cenaNetto").val()) * $("#vat").val()) );
        });
    });
</script>
