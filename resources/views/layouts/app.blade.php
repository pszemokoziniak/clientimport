<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- <script src="{{ asset('js/bootstrap.js') }}" defer></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>
    @if(Session::has('saveform'))
    <script>
        swal("Dobra Robota", "Formularz Zapisany", "success");
    </script>
    @endif
    @if(Session::has('sendMail'))
    <script>
        swal("Dobra Robota", "Email Wysłany", "success");
    </script>
    @endif

    <div id="app">

            @include('navbar')
        <div class="container" style="margin-top:100px">

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>