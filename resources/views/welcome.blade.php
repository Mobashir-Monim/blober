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
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Montserrat', 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .lg-font {
                font-size: 2em;
                width: 50vw;
                padding-left: 10% !important;
                padding-right: 10% !important;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}" class="bg-dark text-white card-rounded px-5 py-1" style="background-color: #171717 !important">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-dark text-white card-rounded px-5 py-1" style="background-color: #171717 !important">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img src="/img/blober-w.svg" class="img-fluid w-25">
                    Blober
                </div>

                <div class="lg-font bg-dark text-white card-rounded px-5">Proficiency in MySQL Queries</div>
            </div>
        </div>
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
