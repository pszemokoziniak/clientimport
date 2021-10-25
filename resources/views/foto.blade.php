<form action="/fotosave" method="post" id="form_foto">
            @csrf
            <input type="hidden" name="id" value="{{$data['id']}}">

            <div class="border_client" id="klient_foto">
            <a type="button" class="btn btn-success w-25 my-3" href={{"/kalkulator/".$data['id']}}>Kalkulator</a>
           
            @if ($ofertaCaunt > 0)  
                    <a type="button" id="oferta-btn" class="btn btn-success w-25 my-3">Oferty Foto</a>
            @endif


            @if ($data->status !== 1) 
                @if ($meetCount==0) 
                    <a type="button" class="btn btn-success w-25 my-3" href={{"/spotkanie/".$data['id']}}>Dodaj Spotkanie</a>
                    @else 
                    <a type="button" class="btn btn-primary w-25 my-3" href={{"/spotkanie/edit/".$data['id']}}>Detale Spotkania</a>
                @endif
            @endif

            <div class="oferta-btn">
                <h2 class="display-5">Oferty</h2>

                @if ($countOferty > 0) 
                    <table style="width:100%">
                        <tr>
                            <td>Il.mod</td><td>Firma</td><td>Moc</td><td>Dach</td><td>Cena netto</td><td>Vat</td><td>Cena brutto</td><td>Wyślij</td><td>Wysłane</td></small>
                        </tr>

                        @foreach($oferty as $items)
                            <small>
                            
                                <tr>
                                    <td>{{$items->iloscModulow}}</td><td>{{$items->firma}}</td><td>{{$items->moc}}</td><td>{{$items->dach}}</td><td>{{$items->cenaNetto}}</td><td>{{$items->vat}}</td><td>{{$items->cenaBrutto}}</td>
                                    <td>
                                        <a href="/fotoOfertaMail/{{$items->id}}"><i class="fas fa-envelope-open-text fa-2x" style="color:blue"></i></a>

                                    </td>
                                    <td>@foreach ($provider::email_status($items->id) as $item) <span style="font-size:x-small"> {{$item->name}} {{$item->created_at}}</span><br /> @endforeach</td>
                                </tr>
                            </small>

                            <!-- <hr class="my-4"> -->
                        @endforeach
                    </table>
                @endif
                <!-- </h5> -->
                <hr>
            </div>

            <h2 class="display-5">Fotowoltaika</h2>

                <h5 class="display-5">Ilość wysłanych ofert: {{$countOferty}}
                <hr class="my-4">
                <div class="row">

            <div class="col">
                <label for="status" class="lead">Status Fotowoltaika</label>
                <select class="w-50 form-control" name="status">
                    @foreach($statusFoto as $status)
                    <option value="{{$status['id']}}" {{$data->statusFoto == $status->id ? 'selected' : '' }}>
                        {{$status['status']}}
                    </option>
                    @endforeach
                </select>
                @error('status')
                <div class="alert-danger w-50">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group mt-3">
                <p class="lead">Dodaj Komentarz</p>
                <textarea class="form-control" name="commentFoto" id="" rows="3"></textarea>
            </div>
            <button type="button" id="save_foto" class="btn btn-success btn-block">Zapisz</button>

            <hr class="my-4">

            <h2 class="display-5">Komentarze</h2>

                @foreach($commentFoto as $comment)
                    <h6 class="display-10">{{$comment->comment}} </h6>
                    <p><small>{{$comment->created_at}} - {{$comment->name}}</small></p>
                    <hr class="my-1">
                @endforeach


                <!-- <div class="col-md form-group row"> -->
            </div>

        </form>
