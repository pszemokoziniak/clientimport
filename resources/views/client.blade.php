<form action="/klient" method="post" id="form">
            @csrf
            <input type="hidden" name="id" value="{{$data['id']}}">
            
            <div class="border_client" id="klient_klient">

                <h1 class="display-5">Dane Klienta
                    <i class="fas fa-phone fa-1x" id="call-btn" style="color:blue; float:right;"></i>
                </h1>
                <iframe id="call-iframe" src="{{URL::to('https://localhost')}}/voip/?page=click2call&clientcall={{$data['nrtelefonu']}}" width="100%" height="200"></iframe>
                <button type="button" id="unblock" class="btn btn-info btn-block">Edit</button>
                <a href="javascript:history.back()" class="btn btn-secondary btn-block">Cofnij</a>

                
                <!-- @if ($data->status == 1) 
                    <a href="/" class="btn btn-secondary btn-block">Cofnij Popraw</a>
                @else
                    <a href="/klienciAktywni" class="btn btn-secondary btn-block">Cofnij</a>
                @endif -->

                
                <hr class="my-4">
                
                <div class="col-md form-group row">
                    <div class="col">
                        <label for="nazwa" class="lead">Nazwa</label>
                        <input class="w-100 form-control" type="text" name="nazwa" value="{{$data['nazwa']}}" disabled>
                            @error('nazwa')
                            <div class="alert-danger">{{$message}}</div>
                            @enderror
                    </div>
                    <div class="col">
                        <label for="nip" class="lead">NIP</label>
                        <input class="w-50 form-control" type="text" name="nip" value="{{$data['nip']}}" disabled>
                            @error('nip')
                            <div class="alert-danger">{{$message}}</div>
                            @enderror
                    </div>
                </div>

                <div class="col-md form-group">
                    <label for="adresmiasto" class="lead">Adres</label>
                    <input class="w-75 form-control" type="text" name="adresmiasto" value="{{$data['adresmiasto']}}" disabled>
                        @error('adresmiasto')
                            <div class="alert-danger">{{$message}}</div>
                        @enderror
                </div>


                <div class="col-md form-group row">
                    <div class="col">
                        <label for="miejscowosc" class="lead">Miejscowość</label>
                        <input class="w-100 form-control" type="text" name="miejscowosc" value="{{$data['miejscowosc']}}" disabled>
                            @error('miejscowosc')
                            <div class="alert-danger">{{$message}}</div>
                            @enderror
                    </div>

                    <div class="col">
                        <label for="kodpocztowy" class="lead">Kod Pocztowy</label>
                        <input class="w-50 form-control" type="text" name="kodpocztowy" value="{{$data['kodpocztowy']}}" disabled>
                            @error('kodpocztowy')
                            <div class="alert-danger">{{$message}}</div>
                            @enderror
                    </div>
                </div>

                <div class="col-md form-group row">
                    <div class="col">
                        <label for="nrtelefonu" class="lead">Numer Tel.</label>
                        <input id="nrtelefonu" class="w-75 form-control" type="text" name="nrtelefonu" value="{{phone($data['nrtelefonu'], 'PL')->formatNational()}}" disabled>
                            @error('nrtelefonu')
                            <div class="alert-danger w-75">{{$message}}</div>
                            @enderror
                    </div>

                    <div class="col">
                        <label for="email" class="lead">Email</label>
                        <input class="w-75 form-control" type="text" name="email" value="{{$data['email']}}" disabled>
                            @error('email')
                            <div class="alert-danger w-75">{{$message}}</div>
                            @enderror
                    </div>
                </div>

                <div class="col-md form-group row">
                    <div class="col">
                        <label for="osobakontaktowa" class="lead">Osoba kontaktowa</label>
                        <input id="osobakontaktowa" class="w-75 form-control" type="text" name="osobakontaktowa" value="{{$data['osobakontaktowa']}}" disabled>
                            @error('osobakontaktowa')
                            <div class="alert-danger w-75">{{$message}}</div>
                            @enderror
                    </div>

                </div>

                <div class="col-md form-group row">
                    <div class="col">

                        <label for="hanlowiec" class="lead">Handlowiec</label>
                        <select class="w-50 form-control" name="handlowiec" disabled>
                            @foreach($users as $user)
                                <option value="{{$user['id']}}" {{$data->handlowiec == $user->id ? 'selected' : '' }}>
                                    {{$user['name']}}
                                </option>
                            @endforeach
                        </select>
                        @error('handlowiec')
                        <div class="alert-danger w-50">{{$message}}</div>
                        @enderror

                    </div>

                    <div class="col">
                        <label for="statusSource" class="lead">Źródło klienta</label>
                        <i class="fas fa-plus-square fa-lg" id="zrodlo_add" style="color:red; cursor:pointer;"></i>

                        <select class="w-50 form-control" name="statusSource" disabled>
                            @foreach($sourceclients as $sourceclient)
                            <option value="{{$sourceclient['id']}}" {{$data->sourceKlient == $sourceclient->id ? 'selected' : '' }}>
                                {{$sourceclient['source']}}
                            </option>
                            @endforeach
                        </select>
                        @error('statusSource')
                        <div class="alert-danger w-50">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md form-group row">
                    <div class="col">
                        <label for="kampania" class="lead">Kampania</label>
                        <i class="fas fa-plus-square fa-lg" id="kampania_add" style="color:red; cursor:pointer;"></i>
                        
                            <select class="w-100 form-control" name="kampania" disabled>
                                <option value="wybierz">wybierz</option>
                                @foreach($pradkampania as $item)
                                    <option value="{{$item['id']}}" {{$data->kampania == $item->id ? 'selected' : '' }}>
                                        {{$item['kampania']}}
                                    </option>
                                @endforeach
                            </select>
                            @error('kampania')
                            <div class="alert-danger w-100">{{$message}}</div>
                            @enderror
                    </div>
                    <div class="col">
                        <label for="branza" class="lead">Branża</label>
                        <i class="fas fa-plus-square fa-lg" id="branza_add" style="color:red; cursor:pointer;"></i>

                            <select class="w-100 form-control" name="branza" disabled>
                                <option value="wybierz">wybierz</option>
                                @foreach($clientbranza as $item)
                                    <option value="{{$item['id']}}" {{$data->branza == $item->id ? 'selected' : '' }}>
                                        {{$item['branza']}}
                                    </option>
                                @endforeach
                            </select>
                            @error('branza')
                            <div class="alert-danger w-100">{{$message}}</div>
                            @enderror
                    </div>

                </div>

                <!-- <hr class="my-4"> -->

                <!-- <div class="form-group">
                    <p class="lead">Dodaj Komentarz</p>
                    <textarea class="form-control" name="comment" id="" rows="3"></textarea>
                </div> -->
                <button type="button" id="save" class="btn btn-success btn-block">Zapisz</button>
            </div>
        </div>
    </form>

 <script>
    $(document).ready(function() {

        $("#branza_add").click(function() {
            event.preventDefault();
            location.href='/ClientBranzaList';
        });
        $("#kampania_add").click(function() {
            event.preventDefault();
            location.href='/kampaniaPradList';
        });
        $("#zrodlo_add").click(function() {
            event.preventDefault();
            location.href='/sourceList';
        });
    });
</script>
