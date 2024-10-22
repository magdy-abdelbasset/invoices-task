@extends('admin.layouts.master')
@php
    if (isset($admin)) {
        $title = __('Edit Admin');
    } else {
        $title = __('Add Admin');
    }
    $old_roles = old("roles",[]);

@endphp
@section('title')
    {{ $title }}
@endsection
@section('content')
    @php
        $nav_items = [
            ['title' => __('Admins'), 'href' => route('dashboard.admins.index')],
            ['title' => $title, 'href' => '#'],
        ];
    @endphp
    @component('components.breadcrump', ['nav_items' => $nav_items])
    @endcomponent

    <x-alert-success></x-alert-success>
    <x-alert-error></x-alert-error>
    <form action="{{ isset($admin) ? route('dashboard.admins.update', $admin->id) : route('dashboard.admins.store') }}"
        enctype="multipart/form-data" method="post">
        @csrf
        @if (isset($admin))
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
                <input type="text" id="email" name="email" value="{{ old('email', $admin->email ?? null) }}"
                    class="@error('email') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Email') }}" >
                @error('email')
                    <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="full_name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Full Name') }}</label>
                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $admin->full_name ?? null) }}"
                    class="@error('full_name') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Full Name') }}" >
                @error('full_name')
                    <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Password') }}</label>
                <input type="password" id="password" name="password" value="{{ old('Password', null) }}"
                    class="@error('password') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Password') }}" >
                @error('password')
                    <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password_confirmation"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Password confirmation') }}</label>
                <input type="password" id="password_confirmation" name="password_confirmation" value=""
                    class="@error('password_confirmation') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Re Enter Password') }}" >
                @error('password_confirmation')
                    <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                @enderror
            </div>
            @if ($admin ?? null)
                <div class="mb-5 hidden text-center">
                    <img src="{{ $admin->image }}" class="w-80 m-auto" alt="" srcset="">
                </div>
            @endif

            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">
                    {{ __('upload Image') }}
                </label>
                <input accept="image/png,image/jpg,image/jpeg"
                    class="block w-full text-sm text-gray-900 p-2 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="image" name="image" type="file">
                @error('image')
                    <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-5 flex gap-5">
                <div class="">

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input {{ old('active', $admin->active ?? 0) == 1 ? 'checked' : null }} type="checkbox"
                            value="1" name="active" class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span
                            class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Active') }}</span>
                    </label>
                </div>
            </div>
            <div class="mb-5 flex gap-5">
                @foreach ($roles as $role)
                <div class="">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input {{ (in_array($role,$old_roles) ? 1 :( isset($admin) ? $admin->hasRole($role) : 0) == 1 )? 'checked' : null }} type="checkbox"
                            value="{{$role}}" name="roles[]" class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span
                            class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $role }}</span>
                    </label>
                </div>
                @endforeach
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
