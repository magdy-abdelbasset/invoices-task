@extends('layouts.app')
@php
    if (isset($setting)) {
        $title = __('messages.edit');
    } else {
        $title = __('messages.add new');
    }
@endphp
@section('title')
    {{ $title }}
@endsection
@section('content')
    @php
        $error_class = 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500';

        $nav_items = [ ['title' => $title, 'href' => '#']];
    @endphp
    @component('components.breadcrump', ['nav_items' => $nav_items])
    @endcomponent

    <x-alert-success></x-alert-success>
    <form
        action="{{  route('dashboard.settings.update') }}"
        enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')
        
        <div class="mt-2 p-8 bg-white rounded-xl">
            <h5 id="drawer-right-label"
                class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg
                    class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg><span class="header">
                    {{ $title }}

                </span></h5>
            @foreach (\App\Utils\Constance::getSetting() as $sett)
                <div class="mb-6">
                    <label for="{{$sett["key"]}}"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $sett["text"]}}</label>
                    <input type="{{$sett["type"]}}" value="{{ old($sett["key"], $setting[$sett["key"]] ?? null) }}" id="{{$sett["key"]}}" name="{{$sett["key"]}}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                     @error($sett["key"]) {{ $error_class }} @enderror"
                        placeholder="{{ $sett["text"] }}">
                    @error($sett["key"])
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach
            <button type="submit"
                class="text-white justify-center flex items-center bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><svg
                    class="w-3.5 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M18 2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2ZM2 18V7h6.7l.4-.409A4.309 4.309 0 0 1 15.753 7H18v11H2Z" />
                    <path
                        d="M8.139 10.411 5.289 13.3A1 1 0 0 0 5 14v2a1 1 0 0 0 1 1h2a1 1 0 0 0 .7-.288l2.886-2.851-3.447-3.45ZM14 8a2.463 2.463 0 0 0-3.484 0l-.971.983 3.468 3.468.987-.971A2.463 2.463 0 0 0 14 8Z" />
                </svg>{{ __('messages.save') }}</button>
        </div>
    </form>
@endsection
