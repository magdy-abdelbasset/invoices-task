<tr id="row-table-{{ $admin->id }}"
    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
    
    <td class="px-6 py-4 ">
        {{ $admin->email }}
    </td>
    <td class="px-6 py-4 image-container">
        <div class="flex gap-2">
            <div href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                <img src="{{ $admin->image }}" alt="" srcset="">
            </div>

        </div>
    </td>
    <td class="px-6 py-4 ">
        {{ __('messages.' . $admin->type) }}
    </td>
    <th class="px-6 py-4 ">
        @foreach($admin->roles as $role)
        <span style="background-color:#{{substr($role->id*$role->id, 0, 1).'0'.'0'.substr($role->id*$role->id, 0, 1).substr($role->id*$role->id, 0, 1).substr($role->id*$role->id, 0, 1)}}" class="text-white font-light py-1 px-2 rounded-full">
            {{$role["name"]}}
        </span>
        @endforeach
    </th>
    <td class="px-6 py-4">
        @if ($admin->active)
            <span
                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ __('messages.Active') }}</span>
        @else
            <span
                class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ __('messages.unactive') }}</span>
        @endif
    </td>
    <td class="px-6 py-4 image-container">
        <div class="flex gap-2">
            @if ($admin->active)
                <a href="#" title="{{ __('messages.action unactive admin') }}"
                    data-action="{{ route('dashboard.admins.unactive', $admin->id) }}"
                    data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                    class="modal-popup font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    <img src="{{ asset('assets/images/remove.png') }}" alt="" srcset="">
                </a>
            @else
                <a href="#" title="{{ __('messages.action active admin') }}"
                    data-action="{{ route('dashboard.admins.active', $admin->id) }}"
                    data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                    class="modal-popup font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    <img src="{{ asset('assets/images/check-mark.png') }}" alt="" srcset="">

                </a>
            @endif


            <a  href="{{ route('dashboard.admins.edit', $admin->id) }}"
                 type="button">
                <img src="{{ asset('assets/images/sign-document-icon.svg') }}" alt="" srcset="">
            </a>
            <a href="#" title="{{ __('messages.action delete admin') }}"
                data-action="{{ route('dashboard.admins.destroy', $admin->id) }}"
                data-method="DELETE"
                data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                class="modal-popup font-medium text-blue-600 dark:text-blue-500 hover:underline">
                <img src="{{ asset('assets/images/garbage-bin-10425.svg') }}" alt="" srcset="">
            </a>
        </div>
    </td>
</tr>
