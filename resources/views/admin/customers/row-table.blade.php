<tr id="row-table-{{ $client->id }}"
    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
    
    <td class="px-6 py-4 ">
        {{ $client->email }}
    </td>
    <td class="px-6 py-4 image-container">
        
        {{ $client->name}}
    </td>
    <td class="px-6 py-4 ">
        
        {{ $client->address}}
    </td>
    <th class="px-6 py-4 ">
        
        {{ $client->phone}}
    </th>
    
    <td class="px-6 py-4 image-container">

            <a  href="{{ route('dashboard.customers.edit', $client->id) }}"
                 type="button">
              تعديل
            </a>
            <a href="#" title="{{ __('messages.action delete client') }}"
            data-action=""
            data-method="DELETE" 
            data-modal-target="popup-modal-{{$client->id}}" data-modal-toggle="popup-modal-{{$client->id}}"
            class="modal-popup font-medium text-blue-600 dark:text-blue-500 hover:underline">
            <img width="20" src="{{ asset('assets/images/garbage-bin-10425.svg') }}" alt="" srcset="">
        </a>


    <div id="popup-modal-{{$client->id}}"  tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-{{$client->id}}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{__("Are you sure ?")}}</h3>
                    <form action="{{ route('dashboard.customers.destroy', $client->id) }}"  accept-charset="UTF-8" name="search-theme-form" id="search-theme-form" method="post">
                        @csrf
                        @method("DELETE")
                        <button type="submit"  class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                           {{__("Yes, I'm sure")}}
                        </button>
                        <button  data-modal-hide="popup-modal-{{$client->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{{__("No, cancel")}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </td>
</tr>
