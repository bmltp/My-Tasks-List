<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome To My Tasks List</title>

        <!-- Fonts -->
        <link href="{{asset('css/bootstrap.min.new.css')}}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
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
                    <div class="pull-right">
                        <a class="btn btn-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </div>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <h1>Welcome To My Tasks List</h1>
                </div>
                <div>
                    <h3>Please select a frontend scaffolding</h3>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <a class="btn btn-outline-secondary" href="/tasks">Basic Boostrap Scaffolding</a>
                    </div>
                    <div class=" col-sm-12 col-md-4 col-lg-4">
                        <a class="btn btn-outline-secondary" href="/ajax">Bootstrap with jQuery and Ajax</a>
                    </div>
                    <div class=" col-sm-12 col-md-4 col-lg-4">
                        <a class="btn btn-outline-secondary" href="/react" >Bootstrap with Reactjs and axios</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
