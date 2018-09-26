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
    <script defer src="https://use.fontawesome.com/releases/v5.0.1/js/all.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="flex fixed w-full justify-between bg-teal-dark p-2">
            <div class="md:w-5/6 p-2">
                <a href="{{ url("/") }}" class="no-underline">
                    <span class="fa fa-tasks text-white"></span>
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
                    <div class="dropdown relative inline-block p-2">
                        <button class="text-white bg-teal-dark font-semibold pt-1 cursor-pointer">
                            {{ auth()->user()->name }}
                            <span class="fas fa-caret-down"></span>
                        </button>
                        <div class="dropdown-content hidden absolute bg-white z-10 py-2 mt-1">
                            <a href="{{ route('logout') }}" class="text-black no-underline py-2 px-6 hover:bg-grey-light"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    Logout
                            </a>
                        </div>

                    </div>
                    

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endguest
            </div>
        </nav>
        @yield('content')

        <flash message="{{ session('flash') }}"></flash>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
