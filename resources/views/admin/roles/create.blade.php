@extends('admin.layouts.master')
@php
    if (isset($role)) {
        $title = __('Edit Role');
    } else {
        $title = __('Add Role');
    }
    $old_permissions = old("permissions",[]);
@endphp
@section('title')
    {{ $title }}
@endsection
@section('content')
    @php
        $nav_items = [
            ['title' => __('Roles'), 'href' => route('dashboard.roles.index')],
            ['title' => $title, 'href' => '#'],
        ];
    @endphp
    @component('components.breadcrump', ['nav_items' => $nav_items])
    @endcomponent

    <x-alert-success></x-alert-success>
    <x-alert-error></x-alert-error>
    <form action="{{ isset($role) ? route('dashboard.roles.update', $role->id) : route('dashboard.roles.store') }}"
        enctype="multipart/form-data" method="post">
        @csrf
        @if (isset($role))
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


                <div class="mb-2">
                    <input type="text" id="name" name="name" value="{{ old('name', $role->name ?? null) }}"
                        class="@error('name') appearance-none  border border-red-500 leading-tight focus:outline-none focus:bg-white-499 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Role Name') }}" >
                    @error('name')
                        <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
                    @enderror
                </div>
            <div class="md:flex mb-5">
                <ul
                    class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">
                    @foreach (__('roles.data') as $item)
                        <li class="li-side-tabs" 
                        >
                            <a href="#"
                            data-icon="{{ asset('assets/images/icons/'.$item["icon"])  }}"
                                data-iconactive="{{ asset('assets/images/icons/'.$item["icon_active"])  }}"
                                class="inline-flex items-center px-4 py-3 rounded-lg w-full  {{$loop->index==0 ? 'text-white bg-blue-700 active dark:bg-blue-600' : 'hover:text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white'}} "
                                data-target-tab="#tab-content-{{$loop->index}}">
                                <object 
                                class=" me-2"
                                data="{{ asset('assets/images/icons/'.($loop->index == 0 ? $item["icon_active"] : $item["icon"]) ) }}" type="image/svg+xml"
                                width="20" height="100%"></object>
                                {{$item["title"]}}
                            </a>
                        </li>
                    @endforeach

                </ul>
                @foreach (__('roles.data') as $item)
                    <div id="tab-content-{{$loop->index}}" class="{{$loop->index!=0 ? 'hidden':''}} tab-content p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2"> {{$item["title"]}}</h3>
                        <div class="ms-2 mt-3 flex items-center justify-between flex-wrap	 gap-5">
                            @foreach ($item["data"] as $val)
                                
                            <div class="w-[200px]">

                                
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input {{ (in_array($val["name"],$old_permissions) ? 1 : (isset($role) ? $role->hasPermissionTo($val["name"]) : 0) == 1) ? 'checked' : null }} type="checkbox"
                                        value="{{$val["name"]}}" name="permissions[]" class="sr-only peer">
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                    </div>
                                    <span
                                    class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $val["title"] }}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach


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
