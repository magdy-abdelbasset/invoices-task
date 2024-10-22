@extends('admin.layouts.master')
@section('title')
    {{ __('invoices') }}
@endsection
@section('content')
    @php
        $nav_items = [['title' => __('Invoices'), 'href' => route('dashboard.invoices.index')]];
    @endphp
    @component('components.breadcrump', ['nav_items' => $nav_items])
    @endcomponent

    <x-alert-success></x-alert-success>
    <x-alert-error></x-alert-error>
    <x-filter>
    </x-filter>

    <div class="flex gap-2 flex-wrap">
        <x-alert-text :title="__('keyword')" text="keyword"></x-alert-text>

    </div>
    <div class="text-left">


        <a href="{{ route('dashboard.invoices.create') }}"
            class="bolder justify-center flex items-center bg-blue-500 hover:bg-blue-200 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-500 rounded">
            <svg class="me-1 ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ __('Add Invoice') }}
        </a>
    </div>


    <x-table>
        <thead class="bg-grey-dark text-white text-normal">
            <tr>
                <th class="px-6 py-3 w-3/12">
                    {{ __('Number') }}
                </th>
                <th class="px-6 py-3 w-3/12">
                    {{ __('Client') }}
                </th>
                <th class="px-6 py-3 w-3/12">
                    {{ __('Date') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Due Date') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Total') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Action') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                @component('admin.invoices.row-table', ['invoice' => $invoice])
                @endcomponent
            @endforeach

        </tbody>

    </x-table>
    <x-pagination :data="$invoices"></x-pagination>
    <x-confirm></x-confirm>
@endsection
