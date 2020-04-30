<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blober</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
        <link rel="icon" href="/img/blober-w.svg" type="image/gif" sizes="16x16">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body class="landing">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-right py-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}" class="bg-dark text-white card-rounded px-5 py-1">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="bg-dark text-white card-rounded px-5 py-1">Login</a>
    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
            <div class="row landing-body">
                <div class="col-md-12 col-12 col-sm-12 col-lg-12 text-center my-auto">
                    <img src="/img/blobler-logo.svg" class="img-fluid landing-logo">
                </div>
            </div>
        </div>
        {{-- <div class="d1"></div>
        <div class="d2"></div>
        <div class="d3"></div>
        <div class="d4"></div> --}}
        <footer class="footer bg-dark text-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        © {{ Carbon\Carbon::now()->format('Y') }}, Eveneer, All rights reserved.
                    </div>
                    <a href="https://www.eveneer.xyz" class="col-md-6 text-right h5 mb-0 my-auto text-white">
                        <img src="/img/eveneer-white.svg" class="w-10 p-2"> Eveneer
                    </a>
                </div>
            </div>
        </footer>
    </body>
</html>
