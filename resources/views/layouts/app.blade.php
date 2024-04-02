<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('http://localhost:5174/') }}">
                    <div class="logo_laravel">
                        <img src="{{ asset('deliveboo1.png') }}" alt="Logo" style="height: 40px">
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- dashboard -->
                    <ul class="navbar-nav ms_mb5px ms_mt5px">
                        <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-primary nav-link"><span
                                    class="plus"></span>{{ __('Pannello Di Controllo') }}</a>
                        </li>
                    </ul>

                    <!-- Ordini -->
                    <ul class="navbar-nav ms_mb5px">
                        <li class="nav-item">
                            <a href="{{ url('/orders') }}" class="btn btn-sm btn-primary nav-link"><span
                                    class="plus"></span>{{ __('Ordini') }}</a>
                        </li>
                    </ul>

                    <!-- menù -->
                    <ul class="navbar-nav me-auto ms_mb5px">
                        <li class="nav-item">
                            <a href="{{ url('/dishes') }}" class="btn btn-sm btn-primary nav-link"><span
                                    class="plus"></span>{{ __('Menù') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn-sm btn-primary nav-link"><span
                                        class="plus"></span>{{ __('Entra') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="btn btn-sm btn-primary nav-link"><span
                                            class="plus"></span>{{ __('Registrati') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a href="#" id="navbarDropdown"
                                    class="btn btn-sm btn-primary nav-link dropdown-toggle" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><span
                                        class="plus"></span>{{ Auth::user()->name }}</a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profilo') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Esci') }}
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

        <main class="">
            @yield('content')
        </main>
    </div>
</body>

<style scoped lang="scss">
    .plus {
        vertical-align: middle;
    }

    .navbar-nav .nav-link {
        border-radius: 100px;
        color: #fff;
        background: #13dbe6;
        margin-right: 10px;
    }

    .ms_mb5px {
        margin-bottom: 5px
    }

    .ms_mt5px {
        margin-top: 5px
    }
</style>


</html>
