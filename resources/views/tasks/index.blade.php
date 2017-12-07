@extends('layouts.app')

@section('content')
    <div class="flex justify-center h-screen pt-24 bg-grey-lighter">
        <div class="w-full max-w-xl flex flex-wrap">
            <div class="md:w-1/4 bg-grey-lighter px-6">
                <ul class="flex flex-col justify-around items-start list-reset pl-2 pb-4 h-32 border-b border-grey-darkest">
                    <li class="text-bold text-lg text-grey-darkest cursor-pointer">
                        <span class="fa fa-sun-o mr-2"></span> Today
                    </li>
                    <li class="text-bold text-lg text-grey-darkest cursor-pointer">
                        <span class="fa fa-calendar-o mr-2"></span> Week
                    </li>
                    <li class="text-bold text-lg text-grey-darkest cursor-pointer">
                        <span class="fa fa-calendar mr-2"></span> Month
                    </li>
                </ul>

               <div class="pt-4">
                   <div class="text-black font-bold text-md text-left ml-2 mb-4">Projects</div>

                   <projects></projects>
               </div>

            </div>
            <div class="md:w-3/4 bg-white h-full border-gray rounded px-4">
                <tasks></tasks>
            </div>
        </div>
    </div>
@endsection