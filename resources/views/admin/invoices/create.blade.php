@extends('admin.layouts.master')
@php
    if (isset($invoice)) {
        $title = __('Edit Invoice');
    } else {
        $title = __('Add Invoice');
    }

@endphp
@section('title')
    {{ $title }}
@endsection
@section("js")
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('') }}assets/js/repeater.min.js"></script>
    <script>
                $('.repeater').repeater({
            initEmpty: true,
            isFirstItemUndeletable: true,
            show: function() {
                $(this).slideDown();
                // $('.advanced-select2').removeAttr("id").removeAttr("data-select2-id");
                $(this).find(".advanced-select2").select2();
            },
            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    </script>
@endsection
@section('content')
    @php
        $nav_items = [
            ['title' => __('Invoices'), 'href' => route('dashboard.invoices.index')],
            ['title' => $title, 'href' => '#'],
        ];
    @endphp
    @component('components.breadcrump', ['nav_items' => $nav_items])
    @endcomponent

    <x-alert-success></x-alert-success>
    <x-alert-error></x-alert-error>
    <form action="{{ isset($invoice) ? route('dashboard.invoices.update', $invoice->id) : route('dashboard.invoices.store') }}"
        enctype="multipart/form-data" method="post">
        @csrf
        @if (isset($invoice))
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

            <div class="mb-5">
                <label for="client_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('Client') }}</label>
                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 " name="client_id">
                    <option value="">-----</option>
                    @foreach ($clients as $client)
                        <option {{ old('client_id',$invoice->client_id ?? null) == $client->id ? 'selected' : null }}  value="{{ $client->id }}">{{ $client->name }} / {{ $client->email }} </option>
                    @endforeach
                </select>
                @error("client_id")
                <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
            @enderror
            </div>
            <div class="mb-6">
                <label for="date"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Date') }}</label>
                <input type="date" id="date" name="date" value="{{ old('email', $invoice->date ?? null) }}"
                    class="@error('date') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Date') }}" >
                @error('date')
                    <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="due_date"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Due Date') }}</label>
                <input type="date" id="due_date" name="due_date" value="{{ old("due_date", $invoice->due_date ?? null) }}"
                    class="@error("due_date") appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Due Date') }}" >
                @error("due_date")
                    <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="total_amount"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Total Amount') }}</label>
                <input type="number" id="total_amount" name="total_amount" value="{{ old('total_amount', $invoice->total_amount ?? null) }}"
                    class="@error('total_amount') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Total Amount') }}" >
                @error('total_amount')
                    <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class=" repeater ">
                <!-- Title -->
                {{-- <h5 class="mb-0 text-primary">
                    {{ $page_title }}</h5> --}}
                <!-- Content -->
                <div class="mt-5" data-repeater-list="items">
                    <div class="row" data-repeater-item>
                        <div class="flex gap-2 justify-between items-center">
                            <div class="mb-6">
                                <label for="quantity"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Quantity') }}</label>
                                <input type="number" id="quantity" name="quantity" 
                                    class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="{{ __('Quantity') }}" required>
                            </div>
                            <div class="mb-6">
                                <label for="number"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Price') }}</label>
                                <input type="number" id="price" name="price" 
                                    class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="{{ __('Price') }}" required >
                            </div>

                            <a type="button" class="w-[100px] text-end" data-repeater-delete>
                                <img width="50" height="50" src="{{ asset('assets/images/garbage-bin-10425.svg') }}" alt="" srcset="">
                            </a>
                        </div>
                        <div class="mb-6">
                            <label for="description" 
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Description') }}</label>
                            <textarea required type="number" id="description" name="description" 
                                class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="{{ __('Description') }}" ></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-end mt-5">
                    <button onclick="return false" class="bolder bg-green-200 hover:bg-green-500 text-gray-900 font-bold font-bold py-2 m-auto px-2 rounded-full"
                        data-repeater-create>New Item</button>
                    <!-- // Details Widget -->
                </div>
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
