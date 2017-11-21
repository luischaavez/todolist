@extends('layouts.app')

@section('content')
    <div class="h-screen flex justify-center items-center">
        <div class="max-w-md lg:flex h-auto">
            <div class="border-r border-b border-l border-grey-light lg:border-t lg:border-grey-light bg-white rounded rounded-b lg:rounded lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                <div class="p-2 text-center">
                    <div class="text-black font-bold text-4xl mb-2">Accomplish everything.</div>
                    <p class="text-grey-darker text-base mb-2">
                        TodoList is the perfect app for those who forget their daily activities.
                    </p>
                    <a href="{{ route("register") }}" class="no-underline">
                        <button class="btn-teal-dark hover:border-teal-dark font-bold p-3 mt-1 uppercase">Get started</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection    