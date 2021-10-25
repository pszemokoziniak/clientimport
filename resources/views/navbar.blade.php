<header class="fixed-top">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- <li class="nav-item active">
                    <a id="len1" class="nav-link" href="/">Nowe<span class="sr-only">(current)</span></a>
                </li> -->

                <li class="nav-item dropdown">
                    <a id="len5" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Klienci
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a id="len1" class="dropdown-item" href="/">Klienci Nowi<span class="sr-only">(current)</span></a>
                        <a class="dropdown-item" href="/klienciAktywni">Klienci Aktywni</a>
                        <a class="dropdown-item" href="/klienciNieAktywni">Klienci Archiwum</a>
                    </div>
                </li>

                <!-- <li class="nav-item">
                    <a id="len2" class="nav-link" href="/klienciAktywni">Klienci</a>
                </li> -->
                <li class="nav-item">
                    <a id="len3" class="nav-link" href="/raport">Raport</a>
                </li>
                <li class="nav-item">
                    <a id="len3" class="nav-link" href="/klienciAll">Wszyscy</a>
                </li>
                <li class="nav-item">
                    <a id="len4" class="nav-link" href="/cennik">Cennik</a>
                </li>
                <li class="nav-item">
                    <a id="len4" class="nav-link" href="/userList">Użytkownicy</a>
                </li>

                <li class="nav-item dropdown">
                    <a id="len5" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Edit
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/statusList">Status Rozmowy</a>
                        <a class="dropdown-item" href="/sourceList">Źródło</a>
                        <a class="dropdown-item" href="/statutesFotoList">Status Foto</a>
                        <a class="dropdown-item" href="/dostawcaPradList">Dostawca Prąd</a>
                        <a class="dropdown-item" href="/taryfaPradList">Taryfe Prąd</a>
                        <a class="dropdown-item" href="/dystrybucjaPradList">Dystrybucja Prąd</a>
                        <a class="dropdown-item" href="/kampaniaPradList">Kampania Prąd</a>
                        <a class="dropdown-item" href="/statusOfertaPradList">Status Prąd</a>
                        <a class="dropdown-item" href="/ClientBranzaList">Branża Klient</a>



                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="import-form">Wgraj Kontakty</a>
                        <!-- <a class="dropdown-item" href="#">Something else here</a> -->
                    </div>
                </li>
                <li class="nav-item">
                    <a id="len4" class="nav-link" href="/log">Log</a>
                </li>

                <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Szukaj" aria-label="Szukaj">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Szukaj</button>
            </form>
        </div>
    </nav>
</header>


<script type="text/javascript">


    $(function() {
        var str = '#len'; //increment by 1 up to 1-nelemnts
        $(document).ready(function() {
            var i, stop;
            i = 1;
            stop = 5; //num elements
            setInterval(function() {
                if (i > stop) {
                    return;
                }
                $('#len' + (i++)).toggleClass('bounce');
            }, 500)

            $('li.active').removeClass('active');
            $('a[href="' + location.pathname + '"]').closest('li').addClass('active');

        });
    });
</script>