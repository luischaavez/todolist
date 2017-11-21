@extends('layouts.app')

@section('content')
    <div class="flex justify-center h-screen pt-8 bg-grey-lighter">
        <div class="w-full max-w-xl flex flex-wrap">
            <div class="md:w-1/3 bg-grey-lighter">
                <ul>
                    <li>Today</li>
                    <li>Week</li>
                    <li>Month</li>
                </ul>
            </div>
            <div class="md:w-2/3 bg-white h-auto border-white rounded">
                <tasks></tasks>
            </div>
        </div>
    </div>
@endsection