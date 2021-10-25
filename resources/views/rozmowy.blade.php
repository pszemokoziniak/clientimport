<form action="/rozmowy" method="post" id="form_rozmowy">
    @csrf
    <input type="hidden" name="id" value="{{$data['id']}}">

    <div class="border_client" id="klient_rozmowy">

        <!-- <div class="jumbotron"> -->

        @if ($errors->any())
            <div class="alert-danger w-50 lead">Formularz nie zapisany</div>

            @foreach ($errors->all() as $error)
            <div class="alert-danger w-50 lead">{{$error}}</div>
            @endforeach
            <br />
        @endif

            <a type="button" class="btn btn-success w-25 my-3" href={{"/setNieobiera/".$data['id']}}>Nie Odbiera</a>

            <h2 class="display-5">Rozmowy telefoniczne</h2>
                <h5 class="display-5">Wykonane telefony: {{$count}} </br>
                    @foreach($lasts as $last)
                        -- <small>{{$last->created_at}}</small>
                    @endforeach

                    <hr class="my-4">

                    @foreach($commentRozmowy as $comment)
                        <h6 class="display-10">{{$comment->comment}} </h6>
                        <p><small>{{$comment->created_at}}</small></p>
                        <hr class="my-1">

                    @endforeach
                </h5>
                <div class="col-md form-group row">

                    <div class="col">
                        <label for="status" class="lead">Status</label>
                        <select class="w-75 form-control" name="status">
                            @foreach($statuses as $status)
                            <option value="{{$status['id']}}" {{$data->status == $status->id ? 'selected' : '' }}>
                                {{$status['status']}}
                            </option>
                            @endforeach
                        </select>
                        @error('status')
                        <div class="alert-danger w-25">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="kontakt_data" class="lead">Data Kontaktu</label>
                        <input class="w-50 form-control" type="date" name="kontakt_data" value="{{$data['kontakt_data']}}">
                            @error('kontakt_data')
                            <div class="alert-danger w-50">{{$message}}</div>
                            @enderror
                    </div>

                    <div class="col">
                        <label for="kontakt_data" class="lead">Godzina Kontaktu</label>
                        <input class="w-50 form-control" type="time" name="kontakt_godzina" value="{{$data['kontakt_godzina']}}">
                            @error('kontakt_godzina')
                            <div class="alert-danger w-50">{{$message}}</div>
                            @enderror
                    </div>

                </div>

                <hr class="my-4">

                <div class="form-group">
                    <p class="lead">Dodaj Komentarz</p>
                    <textarea class="form-control" name="comment" id="" rows="3"></textarea>
                </div>

                <button type="button" id="save_rozmowy" class="btn btn-success btn-block">Zapisz</button>
        <!-- </div> -->
    </div>
</form>
