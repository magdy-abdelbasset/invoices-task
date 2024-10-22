<tr id="row-table-{{ $role->id }}"
    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
    
    <td class="px-6 py-4 ">
    {{ $role->id }}
    </td>
    <td class="px-6 py-4 w-full">
        {{ $role->name }}
    </td>
    
    <td class="px-6 py-4 image-container">
        <div class="flex gap-2">
            <a  href="{{ route('dashboard.roles.edit', $role->id) }}"
                 type="button">
                <img src="{{ asset('assets/images/sign-document-icon.svg') }}" alt="" srcset="">
            </a>
            <a href="#" title="{{ __('action delete role') }}"
                data-action="{{ route('dashboard.roles.destroy', $role->id) }}"
                data-method="DELETE"
                data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                class="modal-popup font-medium text-blue-600 dark:text-blue-500 hover:underline">
                <img src="{{ asset('assets/images/garbage-bin-10425.svg') }}" alt="" srcset="">
            </a>
        </div>
    </td>
</tr>
