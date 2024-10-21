@extends('layouts.app')
@section('title')
    {{ __('blog::messages.articles') }}
@endsection
@section('content')
    @php
        $nav_items = [['title' =>  __('blog::messages.articles') , 'href' => route('dashboard.blog.articles.index')]];
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
            <label for="f_article_category_id"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                {{ __('messages.Category') }}
            </label>
            <select id="f_article_category_id" name="f_article_category_id"
                class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">-----</option>
                @foreach ($categories as $category)
                    
                    <option {{ request('f_article_category_id') == $category->id ? 'selected' : null }} value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-5">
            <label for="f_active"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.Active2') }}
            </label>
            <select id="f_active" name="f_active"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">-----</option>
                <option {{ request('f_active') == '1' ? 'selected' : null }} value="1">{{ __('messages.Active') }}</option>
                <option {{ request('f_active') == '0' ? 'selected' : null }} value="0">{{ __('messages.UnActive') }}
                </option>
            </select>
        </div>
        <div class="mb-5">
            <label for="f_special"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('blog::messages.special') }}
            </label>
            <select id="f_special" name="f_special"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">-----</option>
                <option {{ request('f_special') == '1' ? 'selected' : null }} value="1">{{ __('blog::messages.special') }}</option>
                <option {{ request('f_special') == '0' ? 'selected' : null }} value="0">{{ __('blog::messages.unspecial') }}
                </option>
            </select>
        </div>
    </x-filter>
    @php
        $active = '';
        $special = '';
        $category_name = '';
        if(request('f_article_category_id')){
            $category_name = \App\Models\ArticleCategory::find(request("f_article_category_id"))->name;
        }
        if (request('f_special')) {
            $special = request('f_special') == '1' ? __('blog::messages.special') : __('blog::messages.unspecial');
        }
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
        <x-alert-select :titleLabel="__('blog::messages.special')" :title="$special" text="f_special"></x-alert-select>
        <x-alert-select :titleLabel="__('messages.Category')" :title="$category_name" text="f_article_category_id"></x-alert-select>
        <x-alert-select :titleLabel="__('messages.language')" :title="$lang" text="f_lang"></x-alert-select>

    </div>
<div class="text-left">

    <a  
     href="{{ route('dashboard.blog.articles.create') }}"
     type="button"  class="flex flex-end inline-flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>

        {{__("messages.add new")}}</a>
</div>

    <x-table>
        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>

                <th class="px-6 py-3">
                    {{ __('messages.language') }}
                </th>

                <th class="px-6 py-3 w-3/12">
                    {{ __('blog::messages.title') }}
                </th>
                <th class="px-6 py-3 w-3/12">
                    {{ __('messages.image') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('messages.Category') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('blog::messages.active2') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('blog::messages.special') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('messages.Action') }}

                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                @component('blog::articles.row-table',["article"=>$article])
                    
                @endcomponent
            @endforeach

        </tbody>

    </x-table>
    <x-pagination :data="$articles"></x-pagination>

    <x-confirm></x-confirm>

@endsection

