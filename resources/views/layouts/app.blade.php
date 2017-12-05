<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TodoList</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="flex fixed w-full justify-between bg-teal-dark p-2">
            <div class="md:w-5/6 p-2">
                <a href="{{ url("/") }}" class="no-underline">
                    <span class="fa fa-list text-white"></span>
                    <span class="font-bold text-white text-xl">TodoList</span>
                </a>
            </div>
            <div class="flex justify-around md:w-1/6 font-sans lg:px-6">
                @guest
                    <a href="{{ route('login') }}" class="btn-teal-dark font-semibold capitalize no-underline p-2">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn-teal-dark font-semibold capitalize no-underline p-2">
                        Register
                    </a>
                @else
                    <a href="{{ route('logout') }}" class="btn-teal-dark font-semibold capitalize no-underline p-2"
                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endguest
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
