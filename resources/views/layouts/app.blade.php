<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" id="csrf">

    <title>{{ config('app.name', 'Blober') }}</title>
    <link rel="icon" href="/img/blober-w.svg" type="image/gif" sizes="16x16">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-tagsinput.js') }}" defer></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @if (!isset($navBool))
            <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm text-white">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="/img/blober-bl-w.svg" class="img-fluid w-10">
                        {{ config('app.name', 'Blober') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @endif

        <main class="py-1">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-12 col-sm-12 col-12">
                        @include('layouts.messages')
                    </div>
                </div>
                <div class="row">
                    @auth
                        @if (!isset($navBool))
                            {{-- <div class="col-md-3 col-sm-3 col-3" id="s-nav">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card sidenav">
                                            <div class="card-header text-white">Side Nav <span><span class="float-right"><i class="fa fas fa-angle-left"></i><i class="fa fas fa-angle-left"></i></span></span></div>
                                            <div class="card-body py-2">
                                                <div class="row mb-2">
                                                    <div class="col-md-12">
                                                        <a href="{{ route('home') }}" class="btn btn-dark w-100">Dashboard</a>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-12 text-right">
                                                        <a href="{{ route('users.edit') }}" class="btn btn-dark w-75">Update Profile</a>
                                                    </div>
                                                </div>
                                                @include('layouts.side-nav')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <sidenav items="{{ json_encode((new App\Helpers\SideNavHelper(auth()->user()))->items) }}"></sidenav>
                        @endif
                    @endauth
                    <div class="col-md col-sm col">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer bg-dark text-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        © {{ Carbon\Carbon::now()->format('Y') }}, Eveneer, All rights reserved.
                    </div>
                    <a href="https://www.eveneer.xyz" target="_blank" class="col-md-6 text-right h5 mb-0 my-auto text-white">
                        <img src="/img/eveneer-white.svg" class="w-10 p-2"> Eveneer
                    </a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
