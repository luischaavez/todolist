@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-sm items-center">
        <div class="text-black font-bold text-lg mb-2 text-center">Login</div>

        <form class="bg-white shadow-lg rounded px-8 pt-6 pb-4" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="mb-4">
                <label for="email" class="block text-grey-darker text-sm font-semibold mb-2">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email"  name="email" value="{{ old('email') }}"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker {{ $errors->has('email') ? 'border-red' : '' }}" required autofocus>

                    @if ($errors->has('email'))
                        <p class="text-red text-xs font-bold pt-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="block text-grey-darker text-sm font-semibold mb-2">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" name="password"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker {{ $errors->has('password') ? 'border-red' : '' }}" required>

                    @if ($errors->has('password'))
                        <p class="text-red text-sm font-bold pt-1">{{ $errors->first('password') }}</p>
                    @endif
                </div>
            </div>

            <div class="my-4 pl-2">
                <label class="block text-grey-dark font-bold">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
            </div>

            <div class="flex flex-col justify-center">
                <button class="text-teal-dark font-bold bg-white border rounded border-teal-dark p-2 hover:bg-teal-dark hover:text-white m-2">
                    Login
                </button>

                <div class="w-full text-center m-2">
                    <a class="no-underline font-bold text-sm text-blue-dark hover:text-blue-darker" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
