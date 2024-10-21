<tr id="row-table-{{$category->id}}"
class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">


<td class="px-6 py-4 ">
    {{ __('messages.' . $category->lang) }}
</td>
<td class="px-6 py-4 ">
    {{ $category->name }} 
</td>
<td class="px-6 py-4">
    @if ($category->active)
        <span
            class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ __('messages.Active') }}</span>
    @else
        <span
            class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ __('messages.unactive') }}</span>
    @endif
</td>
<td class="px-6 py-4 image-container">
    <div class="flex gap-2">
        @if ($category->active)
            <a href="#" title="{{ __('messages.action unactive category') }}"
                data-action="{{ route('dashboard.blog.categories.unactive', $category->id) }}"
                data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                class="modal-popup font-medium text-blue-600 dark:text-blue-500 hover:underline">
                <img src="{{ asset('assets/images/remove.png') }}" alt="" srcset="">
            </a>
        @else
            <a href="#" title="{{ __('messages.action active category') }}"
                data-action="{{ route('dashboard.blog.categories.active', $category->id) }}"
                data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                class="modal-popup font-medium text-blue-600 dark:text-blue-500 hover:underline">
                <img src="{{ asset('assets/images/check-mark.png') }}" alt="" srcset="">

            </a>
        @endif
        <a class="modal-crud"
        data-data="{{json_encode($category)}}"
        href="#" data-action="{{ route('dashboard.blog.categories.update',$category->id) }}"
 type="button" data-modal-target="crud-modal" data-modal-toggle="crud-modal"  >
            <img src="{{asset("assets/images/sign-document-icon.svg")}}" alt="" srcset="">
        </a>
    </div>
</td>
</tr>
