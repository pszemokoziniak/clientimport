@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        @role('admin')
        <div class="col-2">Użytkownik</div>
        <div class="col-2">Email</div>
        <div class="col-2">Telefon</div>
        <div class="col-2">Status</div>
        <div class="col-2">Uprawnienia</div>
        <div class="col-2">Akcja</div>
        @endrole
    </div>
    @foreach($data as $item)
    <div class="row">
        <div class="col-2">{{$item->name}}</div>
        <div class="col-2">{{$item->email}}</div>
        <div class="col-2"><input type="text" value="{{$item->phone}}"></div>
        <div class="col-2">
            <div id="offline" data-user="{{$item->id}}">
            @if ($item->admin_level===1)
                <i id="on_user" status="0" style="color:green;" class="fas fa-circle-notch fa-2x pointer"></i>
            @else
                <i id="off_user" status="1" style="color:red;" class="fas fa-circle-notch fa-2x pointer"></i>
            @endif
            </div>
        </div>
        <div class="col-2">
            <select class="form-select" aria-label="Admin">
                <option value="1">User{{$item->admin_level}}</option>
                <option value="2">Menager</option>
                <option value="3">Admin</option>
            </select>    
        </div>
        <div class="col-2">
            <!-- <a type="button" class="btn btn-primary w-50" href={{"userEdit/".$item->id}}>Popraw</a> -->
            <a type="button" class="btn btn-danger w-50" href={{"userDelete/".$item->id}}>Usuń</a>
        </div>
    </div>
    @endforeach
    <table class="table">
        <thead>
            <tr>
                <!-- <th scope="col">Id</th> -->
                <th scope="col">Użytkownik</th>
                <th scope="col">Email</th>
                <th scope="col">Telefon</th>
                <th scope="col">Admin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <!-- <td>{{$item->id}}</td> -->
                <td><strong>{{$item->name}}</strong></td>
                <td><strong>{{$item->email}}</strong></td>
                <td><strong>{{$item->phone}}</strong></td>
                <td><strong>{{$item->admin_level}}</strong></td>

                <td>
                    <a type="button" class="btn btn-primary w-50" href={{"userEdit/".$item->id}}>Popraw</a><br />
                    <a type="button" class="btn btn-danger w-50" href={{"userDelete/".$item->id}}>Usuń</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> -->
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <!-- <form action="" method="post" > -->
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" id="email" name="email" class="form-control input-lg" placeholder="Wpisz mail dodawanego użytkownika">
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary float-right" id="register-btn">Dodaj użytkownika</button>
                                </div>
                            </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

    $("#on_user").click(function() {
    
    let on = $("#on_user").attr('status');
    let id = $('#offline').attr('data-user');

    // alert(on);
    // const email = $('#email').val();
        const options = {
            method: 'post',
            url: '/user/allow',
            data: {
                on: on,
                id: id,
            }
        }
        axios(options)
        .then(function (response) {
            $("#offline").html('<i id="off_user" value="0" style="color:red;" class="fas fa-circle-notch fa-2x"></i>');
            console.log(response);
        })
        .catch(function (response) {
            //handle error
            console.log(response);
        });
    });

    $("#off_user").click(function() {
    
    let on = $("#off_user").attr('status');
    let id = $('#offline').attr('data-user');

        const options = {
            method: 'post',
            url: '/user/allow',
            data: {
                on: on,
                id: id,
            }
        }
        axios(options)
        .then(function (response) {
            $("#offline").html('<i id="on_user" status="0" style="color:green;" class="fas fa-circle-notch fa-2x"></i>');
            console.log(response);
        })
        .catch(function (response) {
            //handle error
            console.log(response);
        });
    });

    $("#register-btn").click(function() {
    
    const email = $('#email').val();
        const options = {
            method: 'post',
            url: '/email/registration',
            data: {
                email: email
            }
        }
        axios(options)
        .then(function (response) {
            //handle success
            console.log(response);
        })
        .catch(function (response) {
            //handle error
            console.log(response);
        });
    });
});

</script>
@endsection