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
                            <a href="{{ url('/home') }}" class="bg-dark text-white card-rounded px-5 py-1" style="background-color: #171717 !important">Home</a>
                            {{-- <a href="{{ url('/home') }}" class="btn btn-dark w-25">Home</a> --}}
                        @else
                            <a href="{{ route('login') }}" class="bg-dark text-white card-rounded px-5 py-1" style="background-color: #171717 !important">Login</a>
    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
            <div class="row landing-body">
                <div class="col-md-5 col-5 col-sm-5 col-lg-5 text-right my-auto">
                    <img src="/img/blober-w.svg" class="img-fluid landing-logo">
                </div>
                <div class="col-md-7 my-auto col-7 col-sm-7 col-lg-7">
                    <h1 class="landing-title">Blober</h1>
                </div>
            </div>
        </div>
        {{-- <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    <img src="/img/blober-w.svg" class="img-fluid w-25">
                    Blober
                </div>

                <div class="lg-font bg-dark text-white card-rounded px-5">Proficiency in MySQL Queries</div>
            </div>
        </div> --}}
        <footer class="footer bg-dark text-white" style="background: #171717 !important">
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
