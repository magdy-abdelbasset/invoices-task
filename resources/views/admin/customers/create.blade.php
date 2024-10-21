@extends('admin.layouts.master')
@php
    if (isset($user)) {
        $title = __('Edit Customer');
    } else {
        $title = __('Add Customer');
    }
    $errors_tabs = [false, false, false, false, false];
    $errors_tabs[0] =(

        $errors->has('email') ||
        $errors->has('mobile') ||
        $errors->has('password') ||
        $errors->has('image') ||
        $errors->has('active') ||
        $errors->has('email_confirmed') ||
        $errors->has('mobile_confirmed')
    );
    $errors_tabs[1] =(

        $errors->has('company') ||
        $errors->has('company.commercial_register') ||
        $errors->has('company.name') ||
        $errors->has('company.company_specialization_id') ||
        $errors->has('company.capital') ||
        $errors->has('company.tax_number') ||
        $errors->has('company.email') ||
        $errors->has('company.address') ||
        $errors->has('company.count_employees') ||
        $errors->has('company.company_mobile') ||
        $errors->has('company.representative_name') ||
        $errors->has('company.representative_mobile') ||
        $errors->has('company.representative_email') ||
        $errors->has('company.credit_inquiry')
    );
    $errors_tabs[2] =(

        $errors->has('financial_statement.budget_from') ||
        $errors->has('financial_statement.budget_to') ||
        $errors->has('company_informations_verfied') ||
        $errors->has('financial_statement_files') ||
        $errors->has('financial_statement_files.*') ||
        $errors->has('cash_flows_files') ||
        $errors->has('cash_flows_files.*') ||
        $errors->has('profit_loss_files') ||
        $errors->has('profit_loss_files.*') ||
        $errors->has('financial_statements_verfied')
    );
    $errors_tabs[3] =(
        $errors->has('commercial_license_files') ||
        $errors->has('commercial_license_files.*') ||
        $errors->has('additional_documents_files') ||
        $errors->has('additional_documents_files.*') ||
        $errors->has('commercial_register_files') ||
        $errors->has('commercial_register_files.*') 


    );
    $errors_tabs[4] =(
        $errors->has('number_of_account') ||
        $errors->has('bank_name') ||
        $errors->has('bank_branch') ||
        $errors->has('statement_account_files') ||
        $errors->has('statement_account_files.*') ||
        $errors->has('bank_account_verfied') ||
        $errors->has('account_verfied')
    );
@endphp
@section('css')
    <style>
        .hasImage:hover section {
            background-color: rgba(5, 5, 5, 0.4);
        }

        .hasImage:hover button:hover {
            background: rgba(5, 5, 5, 0.45);
        }

        #overlay p,
        i {
            opacity: 0;
        }

        #overlay.draggedover {
            background-color: rgba(255, 255, 255, 0.7);
        }

        #overlay.draggedover p,
        #overlay.draggedover i {
            opacity: 1;
        }

        .group:hover .group-hover\:text-blue-800 {
            color: #2b6cb0;
        }
    </style>
@endsection
@section('title')
    {{ $title }}
@endsection
@section('content')
    @php
        $nav_items = [
            ['title' => __('Customers'), 'href' => route('dashboard.customers.index')],
            ['title' => $title, 'href' => '#'],
        ];
    @endphp
    @component('components.breadcrump', ['nav_items' => $nav_items])
    @endcomponent

    <x-alert-success></x-alert-success>
    <x-alert-error></x-alert-error>
    <ul
        class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
        <li class="me-2">
            <a href="#" target-top-tab="#user" aria-current="page"
                class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500">Login
                Data
                <div class="{{ $errors_tabs[0] ? 'tab-valied' : '' }}"></div>
            </a>
        </li>
        <li class="me-2">
            <a href="#" target-top-tab="#company"
                class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Company
                Data
                <div class="{{ $errors_tabs[1] ? 'tab-valied' : '' }}"></div>
            </a>
        </li>
        <li class="me-2">
            <a href="#" target-top-tab="#financial_statements"
                class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Financial
                Statements
                <div class="{{ $errors_tabs[2] ? 'tab-valied' : '' }}"></div>
            </a>
        </li>
        <li class="me-2">
            <a href="#" target-top-tab="#company-documents"
                class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Company
                Documents
                <div class="{{ $errors_tabs[3] ? 'tab-valied' : '' }}"></div>
            </a>
        </li>
        <li>
            <a href="#" target-top-tab="#bank-account"
                class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Bank
                Account
                <div class="{{ $errors_tabs[4] ? 'tab-valied' : '' }}"></div>
            </a>
        </li>
    </ul>
    <form action="{{ isset($user) ? route('dashboard.customers.update', $user->id) : route('dashboard.customers.store') }}"
        enctype="multipart/form-data" method="post">
        @csrf
        @if (isset($user))
            @method('PATCH')
        @else
            @method('POST')
        @endif
        <div class="mt-2 p-8 bg-white rounded-xl top-tab-content">
            <div id="user">
                <h5 id="drawer-right-label"
                    class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg
                        class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg><span class="header">
                        {{ __('Login Data') }}

                    </span></h5>

                <div class="mb-6">
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Email') }}</label>
                    <input type="text" id="email" name="email" value="{{ old('email', $user->email ?? null) }}"
                        class="@error('email') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Email') }}">
                    @error('email')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="mobile"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Mobile') }}</label>
                    <input type="text" id="mobile" name="mobile" value="{{ old('mobile', $user->mobile ?? null) }}"
                        class="@error('mobile') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Mobile') }}">
                    @error('mobile')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Password') }}</label>
                    <input type="password" id="password" name="password" value="{{ old('Password', null) }}"
                        class="@error('password') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Password') }}">
                    @error('password')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="password_confirmation"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Password Confirmation') }}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" value=""
                        class="@error('password_confirmation') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Password Confirmation') }}">
                    @error('password_confirmation')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                @if ($user ?? null)
                    <div class="mb-5 hidden text-center">
                        <img src="{{ $user->image }}" class="w-80 m-auto" alt="" srcset="">
                    </div>
                @endif
                <div class="mb-6">
                    <label for="forget_code"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Forget Code') }}</label>
                    <input type="text" id="forget_code" name="forget_code" value=""
                        class="@error('forget_code') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Forget Code') }}">
                    @error('forget_code')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                @if ($user ?? null)
                    <div class="mb-5 hidden text-center">
                        <img src="{{ $user->image }}" class="w-80 m-auto" alt="" srcset="">
                    </div>
                @endif
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">
                        {{ __('messages.upload Image') }}
                    </label>
                    <input accept="image/png,image/jpg,image/jpeg"
                        class="block w-full text-sm text-gray-900 p-2 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="image" name="image" type="file">
                    @error('image')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5 flex gap-5 justify-between items-center">
                    <div class="">

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input {{ old('active', $user->active ?? 0) == 1 ? 'checked' : null }} type="checkbox"
                                value="1" name="active" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span
                                class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('messages.Active') }}</span>
                        </label>
                    </div>
                    <div class="">

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input {{ old('email_confirmed', $user->email_verified_at ?? 0) == 1 ? 'checked' : null }}
                                type="checkbox" value="1" name="email_confirmed" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span
                                class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Email Confirmed') }}</span>
                        </label>
                    </div>
                    <div class="">

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input {{ old('mobile_confirmed', $user->mobile_verified_at ?? 0) == 1 ? 'checked' : null }}
                                type="checkbox" value="1" name="mobile_confirmed" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span
                                class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Mobile Confirmed') }}</span>
                        </label>
                    </div>
                </div>
            </div>
            <div id="company" class="hidden">
                <h5 id="drawer-right-label"
                    class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg
                        class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg><span class="header">
                        {{ __('Company Data') }}

                    </span></h5>

                <div class="mb-6">
                    <label for="commercial_register"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Commercial Register') }}</label>
                    <input type="text" id="company_commercial_register" name="company[commercial_register]"
                        value="{{ old('company.commercial_register', $user->commercial_register ?? null) }}"
                        class="@error('company.commercial_register') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Commercial Register') }}">
                    @error('company.commercial_register.')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('Specialization') }}</label>
                    <select class="select2 " name="company[company_specialization_id]">
                        <option value="">-----</option>
                        @foreach ($specializations as $specialization)
                            <option {{ old('company.company_specialization_id',$user->company->company_specialization_id ?? null) == $specialization->id ? 'selected' : null }}  value="{{ $specialization->id }}">{{ $specialization->name }} </option>
                        @endforeach
                    </select>
                    @error('company.company_specialization_id')
                    <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                @enderror
                </div>
                <div class="mb-6">
                    <label for="company_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Name') }}</label>
                    <input type="text" id="company_name" name="company[name]"
                        value="{{ old('company.name', $user->company?->name ?? null) }}"
                        class="@error('company.name') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Name') }}">
                    @error('company.namcompany.company_specialization_ide')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="company_capital"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Capital') }}</label>
                    <input type="text" id="company_capital" name="company[capital]"
                        value="{{ old('company.capital', $user->company?->capital ?? null) }}"
                        class="@error('company.capital') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Capital') }}">
                    @error('company.capital')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="company_tax_number"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tax Number') }}</label>
                    <input type="text" id="company_tax_number" name="company[tax_number]"
                        value="{{ old('company.tax_number', $user->company?->tax_number ?? null) }}"
                        class="@error('company.tax_number') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Tax Number') }}">
                    @error('company.tax_number')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="company_email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Email') }}</label>
                    <input type="text" id="company_email" name="company[email]"
                        value="{{ old('company.email', $user->company?->email ?? null) }}"
                        class="@error('company.email') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Email') }}">
                    @error('company.email')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="company_address"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Address') }}</label>
                    <input type="text" id="company_address" name="company[address]"
                        value="{{ old('company.address', $user->company?->address ?? null) }}"
                        class="@error('company.address') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Address') }}">
                    @error('company.address')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="company_count_employees"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Count Employees') }}</label>
                    <input type="number" id="company_count_employees" name="company[count_employees]"
                        value="{{ old('company.count_employees', $user->company?->count_employees ?? null) }}"
                        class="@error('company.count_employees') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Count Employees') }}">
                    @error('company.count_employees')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="company_company_mobile"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Company Mobile') }}</label>
                    <input type="text" id="company_company_mobile" name="company[company_mobile]"
                        value="{{ old('company.company_mobile', $user->company?->company_mobile ?? null) }}"
                        class="@error('company.company_mobile') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Mobile') }}">
                    @error('company.company_mobile')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="company_representative_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Representative Name') }}</label>
                    <input type="text" id="company_representative_name" name="company[representative_name]"
                        value="{{ old('company.representative_name', $user->company?->representative_name ?? null) }}"
                        class="@error('company.representative_name') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Representative Name') }}">
                    @error('company.representative_name')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="company_representative_mobile"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Mobile') }}</label>
                    <input type="text" id="company_representative_mobile" name="company[representative_mobile]"
                        value="{{ old('company.representative_mobile', $user->company?->representative_mobile ?? null) }}"
                        class="@error('company.representative_mobile') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Representative Mobile') }}">
                    @error('company.representative_mobile')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="company_representative_email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Mobile') }}</label>
                    <input type="text" id="company_representative_email" name="company[representative_email]"
                        value="{{ old('company.representative_email', $user->company?->representative_email ?? null) }}"
                        class="@error('company.representative_email') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Representative Email') }}">
                    @error('company.representative_email')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5 flex gap-5 justify-between items-center">
                    <div class="">

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input
                                {{ old('company.credit_inquiry', $user->company->credit_inquiry ?? 0) == 1 ? 'checked' : null }}
                                type="checkbox" value="1" name="company[credit_inquiry]" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span
                                class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Credit Inquiry') }}</span>
                        </label>
                    </div>
                    <div class="">

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input
                                {{ old('company_informations_verfied', $user->company_informations_verfied_at ?? 0) == 1 ? 'checked' : null }}
                                type="checkbox" value="1" name="company_informations_verfied" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span
                                class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Company Informations Verfied') }}</span>
                        </label>
                    </div>
                </div>
            </div>
            <div id="financial_statements" class="hidden">
                <h5 id="drawer-right-label"
                    class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg
                        class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg><span class="header">
                        {{ __('Financial Statements') }}

                    </span></h5>
                <div class="mb-6">
                    <label for="financial_statement_budget_from"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Budget From') }}</label>
                    <input type="number" id="financial_statement_budget_from" name="financial_statement[budget_from]"
                        value="{{ old('financial_statement.budget_from', $user->financial_statement?->budget_from ?? null) }}"
                        class="@error('financial_statement.budget_from') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Representative Name') }}">
                    @error('financial_statement.budget_from')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="financial_statement_budget_to"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Budget From') }}</label>
                    <input type="number" id="financial_statement_budget_to" name="financial_statement[budget_to]"
                        value="{{ old('financial_statement.budget_to', $user->financial_statement?->budget_to ?? null) }}"
                        class="@error('financial_statement.budget_to') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Representative Name') }}">
                    @error('financial_statement.budget_to')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <x-input-files fileTemplate="financial_statement_files_temp"
                        imageTemplate="financial_statement_files_img" empty="financial_statement_files_empty"
                        gallery="financial_statement_files_gallery" overlay="financial_statement_files_overlay"
                        hiddenInput="financial_statement_files" button="financial_statement_files_button"
                        gallery="financial_statement_files_gallery" :title="__('Financial Statement Files')"></x-input-files>
                </div>
                <div class="mb-5">
                    <x-input-files fileTemplate="cash_flows_files_temp" imageTemplate="cash_flows_files_img"
                        empty="cash_flows_files_empty" gallery="cash_flows_files_gallery"
                        overlay="cash_flows_files_overlay" hiddenInput="cash_flows_files"
                        button="cash_flows_files_button" gallery="cash_flows_files_gallery"
                        :title="__('Cash Flows Files')"></x-input-files>
                </div>
                <div class="mb-5">
                    <x-input-files fileTemplate="profit_loss_files_temp" imageTemplate="profit_loss_files_img"
                        empty="profit_loss_files_empty" gallery="profit_loss_files_gallery"
                        overlay="profit_loss_files_overlay" hiddenInput="profit_loss_files"
                        button="profit_loss_files_button" gallery="profit_loss_files_gallery"
                        :title="__('Profit Loss Files')"></x-input-files>
                </div>
                <div class="mb-5 flex gap-5 justify-between items-center">
                    <div class="">

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input
                                {{ old('financial_statements_verfied', $user->financial_statements_verfied_at ?? 0) == 1 ? 'checked' : null }}
                                type="checkbox" value="1" name="financial_statements_verfied" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span
                                class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Financial Statements Verfied') }}</span>
                        </label>
                    </div>
                </div>
            </div>
            <div id="company-documents" class="hidden">
                <h5 id="drawer-right-label"
                    class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg
                        class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg><span class="header">
                        {{ __('Company Documents') }}

                    </span></h5>
                <div class="mb-5">
                    <x-input-files fileTemplate="commercial_license_files_temp"
                        imageTemplate="commercial_license_files_img" empty="commercial_license_files_empty"
                        gallery="commercial_license_files_gallery" overlay="commercial_license_files_overlay"
                        hiddenInput="commercial_license_files" button="commercial_license_files_button"
                        gallery="commercial_license_files_gallery" :title="__('Commercial License Files')"></x-input-files>
                </div>
                <div class="mb-5">
                    <x-input-files fileTemplate="additional_documents_files_temp"
                        imageTemplate="additional_documents_files_img" empty="additional_documents_files_empty"
                        gallery="additional_documents_files_gallery" overlay="additional_documents_files_overlay"
                        hiddenInput="additional_documents_files" button="additional_documents_files_button"
                        gallery="additional_documents_files_gallery" :title="__('Additional Documents Files')"></x-input-files>
                </div>
                <div class="mb-5">
                    <x-input-files fileTemplate="commercial_register_files_temp"
                        imageTemplate="commercial_register_files_img" empty="commercial_register_files_empty"
                        gallery="commercial_register_files_gallery" overlay="commercial_register_files_overlay"
                        hiddenInput="commercial_register_files" button="commercial_register_files_button"
                        gallery="commercial_register_files_gallery" :title="__('Commercial Register Files')"></x-input-files>
                </div>
                <div class="mb-5 flex gap-5 justify-between items-center">
                    <div class="">

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input
                                {{ old('company_documents_verfied', $user->company_documents_verfied_at ?? 0) == 1 ? 'checked' : null }}
                                type="checkbox" value="1" name="company_documents_verfied" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span
                                class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Company Documents Verfied') }}</span>
                        </label>
                    </div>
                </div>
            </div>
            <div id="bank-account" class="hidden">
                <h5 id="drawer-right-label"
                    class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg
                        class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg><span class="header">
                        {{ __('Bank Account') }}

                    </span></h5>
                <div class="mb-6">
                    <label for="number_of_account"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Account Number') }}</label>
                    <input type="text" id="number_of_account" name="number_of_account"
                        value="{{ old('number_of_account', $user->main_bank_account?->number_of_account ?? null) }}"
                        class="@error('number_of_account') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Account Number') }}">
                    @error('number_of_account')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="bank_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Bank Name') }}</label>
                    <input type="text" id="bank_name" name="bank_name"
                        value="{{ old('bank_name', $user->main_bank_account?->bank_name ?? null) }}"
                        class="@error('bank_name') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Bank Name') }}">
                    @error('bank_name')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="bank_branch"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Bank Branch') }}</label>
                    <input type="text" id="bank_branch" name="bank_branch"
                        value="{{ old('bank_branch', $user->financial_statement?->bank_branch ?? null) }}"
                        class="@error('bank_branch') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Bank Branch') }}">
                    @error('bank_branch')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <x-input-files fileTemplate="statement_account_files_temp" imageTemplate="statement_account_files_img"
                        empty="statement_account_files_empty" gallery="statement_account_files_gallery"
                        overlay="statement_account_files_overlay" hiddenInput="statement_account_files"
                        button="statement_account_files_button" gallery="statement_account_files_gallery"
                        :title="__('Commercial Register Files')"></x-input-files>
                </div>
                <div class="mb-5 flex gap-5 justify-between items-center">
                    <div class="">

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input
                                {{ old('bank_account_verfied', $user->bank_account_verfied_at ?? 0) == 1 ? 'checked' : null }}
                                type="checkbox" value="1" name="bank_account_verfied" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span
                                class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Bank Account Verfied') }}</span>
                        </label>
                    </div>
                    <div class="">

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input {{ old('account_verfied', $user->account_verfied_at ?? 0) == 1 ? 'checked' : null }}
                                type="checkbox" value="1" name="account_verfied" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span
                                class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Account Verfied') }}</span>
                        </label>
                    </div>
                </div>
            </div>
            <button type="submit"
                class="w-5/12 bolder justify-center flex items-center  bg-gray-200 hover:bg-gray-500 text-gray-900 font-bold font-bold py-4 m-auto px-6 rounded-full">
                {{ __('messages.save') }} <svg class="w-3.5 h-3.5 me-1 ms-1" aria-hidden="true"
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

@section('js')
@endsection
