<div class="container">
    <form action="/cennik" method="post" id="form">
            @csrf
            <div class="jumbotron">
            <input type="hidden" value="{{ request()->route('id') }}" name="id_client">
            <div class="col-md form-group row">

                <div class="col">
                    <label for="ilModulow" class="lead">Ilość Modułów</label>
                    <input id="ilModulow" class="w-50 form-control test" type="text" name="ilModulow" value="{{ old('ilModulow') }}">
                        @error('ilModulow')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                </div>

                <div class="col">
                    <label for="firma" class="lead">Firma</label>
                    <select class="w-75 form-control wymagane" name="firma">
                        <option slected>wybierz</option>
                        @foreach($solarName as $item)
                        <option value="{{$item['id']}}">
                            {{$item['name']}}
                        </option>
                        @endforeach
                    </select>
                        @error('firma')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                </div>

                <div class="col">
                    <label for="mocInstalacji" class="lead">Moc Instalacji</label>
                    <input id="mocInstalacji" class="w-50 form-control" type="text" name="mocInstalacji" value="{{ old('mocInstalacji') }}">
                        @error('mocInstalacji')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                </div>

            </div>

            <div class="col-md form-group row">

                <div class="col">
                    <label for="plaski" class="lead">Dach Płaski</label>
                    <input id="plaski" class="w-75 form-control" type="text" name="plaski" value="{{ old('plaski') }}">
                        @error('plaski')
                        <div class="w-75 alert-danger">{{$message}}</div>
                        @enderror
                </div>

                <div class="col">
                    <label for="skosny" class="lead">Dach Skośny</label>
                    <input id="skosny" class="w-75 form-control" type="text" name="skosny" value="{{ old('skosny') }}">
                        @error('skosny')
                        <div class="w-75 alert-danger">{{$message}}</div>
                        @enderror
                </div>

                <div class="col">
                    <label for="grunt" class="lead">Grunt</label>
                    <input id="grunt" class="w-75 form-control" type="text" name="grunt" value="{{ old('grunt') }}">
                        @error('grunt')
                        <div class="w-75 alert-danger">{{$message}}</div>
                        @enderror
                </div>
            </div>

                <button type="submit" id="save" class="btn btn-success btn-block">Zapisz</button>
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
});
</script>


