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
        <nav class="flex p-5 justify-between bg-teal-dark p-4">
            <div class="md:w-3/4 p-2">
                <span class="fa fa-check-circle-o text-white"></span>
                <span class="font-bold text-white text-lg">TodoList</span>
            </div>
            <div class="flex justify-around md:w-1/4 font-sans">
                <a href="{{ route("login") }}" class="text-white font-semibold capitalize no-underline border rounded border-white p-2">
                    Login
                </a>
                <a href="{{ route("register") }}" class="text-white font-semibold capitalize no-underline border rounded border-white p-2">
                    Register
                </a>
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
