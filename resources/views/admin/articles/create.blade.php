@extends('layouts.app')
@php
    if (isset($article)) {
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

        $nav_items = [['title' => __('blog::messages.articles'), 'href' => route('dashboard.blog.articles.index')], ['title' => $title, 'href' => '#']];
    @endphp
    @component('components.breadcrump', ['nav_items' => $nav_items])
    @endcomponent

    <x-alert-success></x-alert-success>
    <form
        action="{{ isset($article) ? route('dashboard.blog.articles.update', $article->id) : route('dashboard.blog.articles.store') }}"
        enctype="multipart/form-data" method="post">
        @csrf
        @if (isset($article))
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
                <label for="lang"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.language') }}
                </label>
                <select id="lang" name="lang"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option>-----</option>
                    @foreach (__('messages.languages_array') as $lang)
                        <option {{ old('lang',$article->lang ?? null) == $lang['name'] ? 'selected' : null }} value="{{ $lang['name'] }}">
                            {{ $lang['label'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-6">
                <label for="title" 
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.title') }}</label>
                <input type="text" id="title" name="title"  value="{{old('title',$article->title ?? null)}}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('messages.title') }}" required>
            </div>
            <div class="mb-5">
                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('messages.Category') }}</label>
                <select class="select2 " name="article_category_id">
                    <option value="">-----</option>
                    @foreach ($categories as $category)
                        <option {{ old('article_category_id',$article->article_category_id ?? null) == $category->id ? 'selected' : null }}  value="{{ $category->id }}">{{ $category->name }} </option>
                    @endforeach
                </select>
            </div>
            @if ($article ?? null)
            <div class="mb-5 hidden text-center">
                <img src="{{$article->image}}" class="w-80 m-auto" alt="" srcset="">
            </div>
            @endif

            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">
                    {{ __('messages.upload Image') }}
                </label>
                <input accept="image/png,image/jpg,image/jpeg"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="image" name="image" type="file">
            </div>
            <div class="mb-5 flex gap-5">
                <div class="">

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input  {{ old('active',$article->active ?? 0) == 1 ? 'checked' : null }} type="checkbox" value="1" name="active" class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span
                            class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('messages.Active') }}</span>
                    </label>
                </div>
                <div class="">

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input {{ old('special',$article->special ?? 0) == 1 ? 'checked' : null }} type="checkbox" name="special" value="1" class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span
                            class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('messages.special') }}</span>
                    </label>
                </div>
            </div>
            <div class="mb-6">
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.description') }}</label>
                <textarea id="description" rows="4" name="description"
                    class="mytextarea block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('messages.description') }}">{!! old('description',$article->description ?? null) !!}</textarea>
            </div>
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
@section('js')
    <script src="{{ asset('assets/lib/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '.mytextarea',
            height: 400,
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help',
                'wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
        });
    </script>
@endsection
