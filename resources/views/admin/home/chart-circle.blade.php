<div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 m-auto lg:col-span-1 col-span-3">

    <div class="flex justify-between mb-3">
        <div class="flex justify-center items-center">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">{{ $title }}</h5>
        </div>
   </div>


    <!-- Donut Chart -->
    <div class="py-6" data-t="{{ $title }}" data-data="{{json_encode($data)}}" id="{{ $id }}"></div>

    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
        <div class="flex justify-between items-center pt-5">
            <!-- Button -->
            <button id="{{ $id }}-dropdownButton" data-dropdown-toggle="{{ $id }}-dropdown"
                data-dropdown-placement="bottom"
                class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                type="button">
                Last 7 days
                <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div id="{{ $id }}-dropdown"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" >
                    <li class="li-days" data-id="{{$id}}" data-url="{{$url}}" data-days="7">
                        <a href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                            7 days</a>
                    </li>
                    <li  class="li-days"  data-id="{{$id}}" data-url="{{$url}}" data-days="30">
                        <a href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                            30 days</a>
                    </li>
                    <li  class="li-days"  data-id="{{$id}}" data-url="{{$url}}" data-days="90">
                        <a href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                            90 days</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
