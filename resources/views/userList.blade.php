@extends('layouts.app')


@section('content')

<div class="container">
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