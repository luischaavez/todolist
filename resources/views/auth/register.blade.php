@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-sm items-center">
        <div class="text-black font-bold text-lg mb-2 text-center">Register</div>

        <form class="bg-white shadow-lg rounded px-8 pt-6 pb-8" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="mb-4">
                <label for="name" class="block text-grey-darker text-sm font-semibold mb-2">Name</label>

                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker {{ $errors->has('name') ? 'border-red' : '' }}" autofocus>

                @if ($errors->has('name'))
                    <p class="text-red text-xs font-bold pt-1">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="email" class="block text-grey-darker text-sm font-semibold mb-2">E-Mail Address</label>

                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker {{ $errors->has('email') ? 'border-red' : '' }}">

                @if ($errors->has('email'))
                    <p class="text-red text-xs font-bold pt-1">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="password" class="block text-grey-darker text-sm font-semibold mb-2">Password</label>

                <input id="password" type="password" name="password"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker {{ $errors->has('password') ? 'border-red' : '' }}">

                @if ($errors->has('password'))
                    <p class="text-red text-xs font-bold pt-1">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div class="mb-6">
                <label for="password-confirm" class="block text-grey-darker text-sm font-semibold mb-2">Confirm Password</label>

                <input id="password-confirm" type="password" name="password_confirmation"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker">
            </div>

            <div class="flex justify-center">
                <button type="submit" class="text-teal-dark font-bold bg-white border rounded border-teal-dark p-2 hover:bg-teal-dark hover:text-white">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
