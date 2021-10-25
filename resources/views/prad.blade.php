<head>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<form action="/pradsave" method="post" id="form_prad">
    @csrf
    <input type="hidden" name="id" id="id_client" value="{{$data['id']}}">
    <div class="border_client" id="klient_prad">

        <a type="button" class="btn btn-success w-20 my-3" style="width:15%" id="show_status">Status</a>
        <a type="button" class="btn btn-success w-20 my-3" style="width:15%" id="show_comm">Komentarze</a>
        <a type="button" class="btn btn-success w-20 my-3" style="width:15%" id="show_faktura">Faktura Klienta</a>
        <a type="button" class="btn btn-success w-20 my-3" style="width:15%" id="show_oferta">Oferta</a>
        <a type="button" class="btn btn-success w-20 my-3" style="width:15%" id="show_umowa">Umowa</a>



    <h2 class="display-5">Prąd</h2>
        <div class="alert alert-success d-none" id="msg_div">
            <span id="res_message"></span>
        </div>


    <!-- <h5 class="display-5">Ilość wysłanych ofert: {{$countOferty}} -->
    <hr class="my-4">
    <!-- <div class="row"> -->
        <div id="status">
            <div class="col">
                <label for="status" class="lead">Status Prąd</label>
                <select class="w-50 form-control" name="status" id="selectStatus">
                    @foreach($statusPrad as $status)
                    <option value="{{$status['id']}}" {{$data->statusPrad == $status->id ? 'selected' : '' }}>
                        {{$status['statusPrad']}}
                    </option>
                    @endforeach
                </select>
                @error('status')
                    <div class="alert-danger w-50">{{$message}}</div>
                @enderror
            </div>
            <!-- <hr class="my-4">
            <button type="button" id="save_prad" class="btn btn-success btn-block">Zapisz</button> -->

        </div>
        <div id="comment">
            <div class="form-group mt-3">
                <p class="lead">Dodaj Komentarz      
                    <i class="fas fa-plus-square fa-lg" id="show_comment" style="color:red; cursor:pointer;"></i>
                </p>  
                <div id="commentPrad">
                    <textarea class="form-control" name="commentPrad" id="commentText" rows="3"></textarea>
                    <button type="button" id="save_prad" class="btn btn-success btn-block">Zapisz</button>
                </div>
            </div>

            <h2 class="display-5">Komentarze</h2>
            <table class="table table-hover" id="my-comment">
                <thead>
                    <tr>
                    <td>Komentarz</td>
                    <td>Info</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($commentPrad as $comment)

                    <tr>
                        <td>{{$comment->comment}}</td>
                        <td><small>{{$comment->created_at}} <br /> {{$comment->name}}</small></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @foreach($commentPrad as $comment)
                <h6 class="display-10">{{$comment->comment}} </h6>
                <p><small>{{$comment->created_at}} - {{$comment->name}}</small></p>
                <hr class="my-1">
            @endforeach
        </div>

        <div id="faktura">
            <a href="/pradFakturaForm/{{$data['id']}}" class="btn btn-success btn-block">Dodaj Dane Faktury Klienta</a>

            <table style="width:90%" id="table_my" class="table table-hover">
                <thead>
                    <tr>
                        <td>Dostawca</td><td>Taryfa</td><td>Volumen</td><td>Start</td><td>Koniec</td><td>Cena klienta</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pradFaktura as $items)
                        <tr>
                            <td>{{$items->firmadostawca}}</td><td>{{$items->taryfa}}</td><td> {{$items->volumen}}</td>
                            <td> {{$items->start}}</td><td> {{$items->end}}</td><td> {{$items->cenaklient}}</td>
                            <td><a href="/pradFakturaEdit/{{$items->id}}" title="Popraw"><i size="3x" class="fas fa-edit fa-2x"> </i></a>      <a href="/pradFakturaArchiwum/{{$items->id}}" title="Archiwizuj"><i class="fas fa-archive fa-2x"></i></a></td>
                        </tr>
                        <!-- <hr class="my-4"> -->
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="oferta">
            <a href="/pradOfertaForm/{{$data['id']}}" class="btn btn-success btn-block">Dodaj Ofertę Prąd</a>
            <table style="width:90%" id="table_my" class="table table-hover">
            <thead>
                <tr>
                    <td>Dostawca</td><td>Taryfa</td><td>Volumen</td><td>Start</td><td>Koniec</td><td>Cena klienta</td><td>Status</td>
                </tr>
            </thead>
            <tbody>
                @foreach($ofertyPrad as $items)
                        <tr>
                            <td>{{$items->firmadostawca}}</td><td>{{$items->taryfa}}</td><td> {{$items->volumen}}</td><td> {{$items->start}}</td><td> {{$items->end}}</td><td> {{$items->cenaklient}}</td><td> {{$items->status}}</td>
                            <td><a href="/pradOfertaEdit/{{$items->id}}" title="Popraw"><i size="3x" class="fas fa-edit fa-2x"> </i></a>      <a href="/pradOfertaArchiwum/{{$items->id}}" title="Archiwizuj"><i class="fas fa-archive fa-2x"></i></a></td>


                        </tr>
                    <!-- <hr class="my-4"> -->
                @endforeach
            </tbody>    
            </table>
            <hr class="my-4">
        </div>
        <div id="umowa">
            <a href="/pradUmowaForm/{{$data['id']}}" class="btn btn-success btn-block">Dodaj Umowę Końcową</a>
            <table style="width:90%" id="table_my" class="table table-hover">
            <thead>
                <tr>
                    <td>Dostawca</td><td>Taryfa</td><td>Volumen</td><td>Start</td><td>Koniec</td><td>Cena klienta</td>
                </tr>
            </thead>
            <tbody>
                @foreach($pradBack as $items)
                        <tr>
                            <td>{{$items->firmadostawca}}</td><td>{{$items->taryfa}}</td><td> {{$items->volumen}}</td><td> {{$items->start}}</td><td> {{$items->end}}</td><td> {{$items->cenaklient}}</td>
                            <td>
                                <a href="/pradUmowaEdit/{{$items->id}}" title="Popraw"><i size="3x" class="fas fa-edit fa-2x"> </i></a>      
                                <a href="/pradUmowaArchiwum/{{$items->id}}" title="Archiwizuj"><i class="fas fa-archive fa-2x"></i></a>
                                <a href="/ftpback/{{$items->id}}" title="Wgraj Plik"><i class="fas fa-upload fa-2x"></i></a>
                            </td>
                        </tr>
                @endforeach
            </table>
        </div>
        </tbody>
    </div>
</form>
<script>
$(document).ready(function() {

    $(document).on('change', '#selectStatus', function() {    
        event.preventDefault();    
        $('#comment').show();
        $('#commentPrad').show();
    });

    $( "#form_prad" ).submit(function( event ) {
        event.preventDefault();
        var status = $('#selectStatus').val();  
        var id_client = $('#id_client').val();
        var comment = $('#commentText').val();  
  
        console.log(status);
        console.log(comment);
  

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('statusPrad.save')}}", //Define Post URL
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                id:id_client,
                status:status,
                comment:comment,
            },
            //Display Response Success Message
            success: function(response){
                console.log((response.msg));

                // $('#comment').show();
                // $('#commentPrad').show();

                $('#res_message').html(response.msg);
                $('#msg_div').removeClass('d-none');

                $('#my-comment').prepend('<tr style="background-color:lightgreen"><td><small>'+response.comment+'</small></td><td><small>'+response.date+'<br />'+response.user+'</small></td></tr>');
                // $('#my-comment tbody tr:last').after('<tr><td'>+response.msg+'</td><td></td></tr>');
                setTimeout(function(){
                    $('#res_message').fadeOut();
                    $('#msg_div').fadeOut();
                    $('#commentPrad').fadeOut('');
                    $('#commentText').val('');

                    },4000);

            },
        });
   });
    $("#save_prad").click(function() {
        event.preventDefault();
        $("#form_prad").submit();
        
    });
    $("#show_faktura").click(function() {
        event.preventDefault();
        $("#faktura").toggle();
        $("#status").hide();
        $("#comment").hide();
        $("#oferta").hide();
        $("#umowa").hide();
    });
    $("#show_oferta").click(function() {
        event.preventDefault();
        $("#oferta").toggle();
        $("#status").hide();
        $("#comment").hide();
        $("#status").hide();
        $("#faktura").hide();
        $("#umowa").hide();
    });
    $("#show_umowa").click(function() {
        event.preventDefault();
        $("#umowa").toggle();
        $("#status").hide();
        $("#comment").hide();
        $("#oferta").hide();
        $("#faktura").hide();

    });
    $("#show_status").click(function() {
        event.preventDefault();
        $("#status").toggle();
        $("#comment").hide();
        $("#oferta").hide();
        $("#faktura").hide();
        $("#umowa").hide();


    })
    $("#show_comm").click(function() {
        event.preventDefault();
        $("#comment").toggle();
        $("#status").hide();
        $("#oferta").hide();
        $("#faktura").hide();
        $("#umowa").hide();
    })

    $("#show_comment").click(function() {
        event.preventDefault();
        $("#commentPrad").toggle();
    })





});

</script>