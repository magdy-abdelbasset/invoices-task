@extends('admin.layouts.master')
@php
    if (isset($client)) {
        $title = __('Edit Client');
    } else {
        $title = __('Add Client');
    }

@endphp
@section('title')
    {{ $title }}
@endsection
@section('content')
    @php
        $nav_items = [
            ['title' => __('Clients'), 'href' => route('dashboard.customers.index')],
            ['title' => $title, 'href' => '#'],
        ];
    @endphp
    @component('components.breadcrump', ['nav_items' => $nav_items])
    @endcomponent

    <x-alert-success></x-alert-success>
    <x-alert-error></x-alert-error>
    <form action="{{ isset($client) ? route('dashboard.customers.update', $client->id) : route('dashboard.customers.store') }}"
        enctype="multipart/form-data" method="post">
        @csrf
        @if (isset($client))
            @method('PATCH')
        @else
            @method('POST')
        @endif
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

            <div class="mb-6">
                <label for="email"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Email') }}</label>
                <input type="text" id="email" name="email" value="{{ old('email', $client->email ?? null) }}"
                    class="@error('email') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Email') }}" >
                @error('email')
                    <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Name') }}</label>
                <input type="text" id="name" name="name" value="{{ old('name', $client->name ?? null) }}"
                    class="@error('name') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Name') }}" >
                @error('name')
                    <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="address"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Address') }}</label>
                <input type="text" id="address" name="address" value="{{ old('address', $client->address ?? null) }}"
                    class="@error('address') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Address') }}" >
                @error('address')
                    <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Phone') }}</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $client->phone ?? null) }}"
                    class="@error('phone') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Phone') }}" >
                @error('phone')
                    <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit"
                class="w-5/12 bolder justify-center flex items-center  bg-gray-200 hover:bg-gray-500 text-gray-900 font-bold font-bold py-4 m-auto px-6 rounded-full">
                {{ __('save') }} <svg class="w-3.5 h-3.5 me-1 ms-1" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M18 2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2ZM2 18V7h6.7l.4-.409A4.309 4.309 0 0 1 15.753 7H18v11H2Z" />
                    <path
                        d="M8.139 10.411 5.289 13.3A1 1 0 0 0 5 14v2a1 1 0 0 0 1 1h2a1 1 0 0 0 .7-.288l2.886-2.851-3.447-3.45ZM14 8a2.463 2.463 0 0 0-3.484 0l-.971.983 3.468 3.468.987-.971A2.463 2.463 0 0 0 14 8Z" />
                </svg>
            </button>
        </div>
    </form>
@endsection
