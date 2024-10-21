@extends('layouts.app')
@section('title')
    {{ __('blog::messages.categories') }}
@endsection
@section('content')
    @php
        $nav_items = [['title' => __('blog::messages.categories') , 'href' => route('dashboard.blog.categories.index')]];
    @endphp
    @component('components.breadcrump', ['nav_items' => $nav_items])
    @endcomponent

    <x-alert-success></x-alert-success>
    <x-filter>
        <div class="mb-5">
            <label for="f_lang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("messages.language")}} </label>
            <select id="f_lang" name="f_lang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">-----</option>
                @foreach (__("messages.languages_array") as $lang)                    
                    <option {{old('f_lang') == $lang["name"] ?'selected' : null}} value="{{$lang["name"]}}">{{$lang["label"]}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-5">
            <label for="active"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.Active2') }}
            </label>
            <select id="active" name="f_active"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">-----</option>
                <option {{ request('f_active') == '1' ? 'selected' : null }} value="1">{{ __('messages.Active') }}</option>
                <option {{ request('f_active') == '0' ? 'selected' : null }} value="0">{{ __('messages.UnActive') }}
                </option>
            </select>
        </div>
    </x-filter>
    @php
        $active = '';
        if (request('f_active')) {
            $active = request('f_active') == '1' ? __('messages.Active') : __('messages.UnActive');
        }
        $lang = '';
        
        if(request("f_lang")&& request("f_lang") !=""){
            $lang = __("messages.".request("f_lang"));
        }
    @endphp
    <div class="flex gap-2 flex-wrap">
        <x-alert-text :title="__('messages.keyword')" text="keyword"></x-alert-text>
        <x-alert-select :titleLabel="__('user::messages.Active')" :title="$active" text="f_active"></x-alert-select>
        <x-alert-select :titleLabel="__('messages.language')" :title="$lang" text="f_lang"></x-alert-select>

    </div>
<div class="text-left">

    <button  
     data-action="{{ route('dashboard.blog.categories.store') }}"
 type="button" data-modal-target="crud-modal" data-modal-toggle="crud-modal"  class="flex flex-end inline-flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                              <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>

        {{__("messages.add new")}}</button>
</div>

    <x-table>
        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th class="px-6 py-3">
                    {{ __('messages.language') }}
                </th>


                <th class="px-6 py-3 w-3/12">
                    {{ __('blog::messages.name') }}
                </th>

                <th scope="col" class="px-6 py-3">
                    {{ __('messages.Active2') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('messages.Action') }}

                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                @component('blog::categories.row-table',["category"=>$category])
                    
                @endcomponent
            @endforeach

        </tbody>

    </x-table>
    <x-pagination :data="$categories"></x-pagination>
    <x-confirm></x-confirm>
    <x-modal-crud>
        <div class="mb-5 col-span-2">
            <label for="lang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("messages.language")}} </label>
            <select id="lang" name="lang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option >-----</option>
                @foreach (__("messages.languages_array") as $lang)                    
                    <option {{old('lang') == $lang["name"] ?'selected' : null}} value="{{$lang["name"]}}">{{$lang["label"]}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-2">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("messages.Name")}}</label>
            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="{{__("messages.Name")}}" required="">
        </div>
        <div class="col-span-2">
            <label for="active" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("messages.Active")}}</label>
            <select id="active" name="active" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option selected="">-----</option>
                <option value="1">{{ __('messages.Active') }} </option>
                <option value="0">{{ __('messages.UnActive2') }}</option>
            </select>
        </div>
    </x-modal-crud>
@endsection
