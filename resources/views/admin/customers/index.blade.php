@extends('admin.layouts.master')
@section('title')
    {{ __('Customers') }}
@endsection
@section('content')
    @php
        $nav_items = [['title' => __('Customers'), 'href' => route('dashboard.customers.index')]];
    @endphp
    @component('components.breadcrump', ['nav_items' => $nav_items])
    @endcomponent

    <x-alert-success></x-alert-success>
    <x-alert-error></x-alert-error>
    <x-filter>
        <div class="mb-5">
            <label for="active"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('user::messages.Active') }}
            </label>
            <select id="active" name="active"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>-----</option>
                <option {{ request('active') == '1' ? 'selected' : null }} value="1">{{ __('messages.Active') }}</option>
                <option {{ request('active') == '0' ? 'selected' : null }} value="0">{{ __('messages.UnActive') }}
                </option>
            </select>
        </div>
    </x-filter>
    @php
        $active = '';
        if (request('active')) {
            $active = request('active') == '1' ? __('messages.Active') : __('messages.UnActive');
        }

    @endphp
    <div class="flex gap-2 flex-wrap">
        <x-alert-text :title="__('messages.keyword')" text="keyword"></x-alert-text>
        <x-alert-select :titleLabel="__('user::messages.Active')" :title="$active" text="active"></x-alert-select>
    </div>

    <div class="text-left">


        <a href="{{ route('dashboard.customers.create') }}"
            class="bolder justify-center flex items-center bg-blue-500 hover:bg-blue-200 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-500 rounded">
            <svg class="me-1 ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ __('Add Customer') }}
        </a>
    </div>
    <x-table>


        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 ">
                    {{ __('Id') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('User') }}
                </th>
                <th scope="col" class="px-6 py-3 ">
                    {{ __('Company Email') }}
                </th>
                <th class="px-6 py-3 w-3/12">
                    {{ __('Company Mobile') }}

                </th>
                <th class="px-6 py-3 w-3/12">
                    {{ __('Created At') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Online') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Active') }}

                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Action') }}

                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @include('admin.users.row-table')
            @endforeach

        </tbody>

    </x-table>
    <x-pagination :data="$users"></x-pagination>
    <x-confirm></x-confirm>
@endsection
