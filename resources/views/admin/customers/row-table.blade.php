<tr
class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
<th>{{ $user->id }}</th>
<td scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
    <img class="w-10 h-10 rounded-full"
        src="{{ !empty($user->image) ? $user->image : asset('assets/images/user.png') }}"
        alt="Jese image">
    <div class="ps-3">
        <div class="text-base font-semibold">{{ $user->company->name }}</div>
        <div class="font-normal text-gray-500">{{ $user->email }}</div>
    </div>
</td>
<td class="px-6 py-4">
    {{ $user->company->email}}
</td>
<td class="px-6 py-4 ">
    {{ $user->company->company_mobile }} 
</td>
<td>{{ $user->created_at}}</td>
<td class="px-6 py-4">
    @if ($user->online)
        <span
            class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ __('online') }}</span>
    @else
        <span
            class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ __('offline') }}</span>
    @endif
</td>
<td class="px-6 py-4">
    @if ($user->active)
        <span
            class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ __('Active') }}</span>
    @else
        <span
            class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ __('Un Active') }}</span>
    @endif
</td>
<td class="px-6 py-4 image-container flex gap-4">
    @if ($user->active)
        <a href="#" title="{{ __('Unactive') }}"
            data-action="{{ route('dashboard.users.unactive', $user->id) }}"
            data-modal-target="popup-modal" data-modal-toggle="popup-modal"
            class="modal-popup font-medium text-blue-600 dark:text-blue-500 hover:underline">
            <img src="{{ asset('assets/images/block-user.png') }}" alt="" srcset="">
        </a>
    @else
        <a title="{{ __('Active') }}" href="#"
            data-action="{{ route('dashboard.users.active', $user->id) }}"
            data-modal-target="popup-modal" data-modal-toggle="popup-modal"
            class="modal-popup font-medium text-blue-600 dark:text-blue-500 hover:underline">
            <img src="{{ asset('assets/images/user.png') }}" alt="" srcset="">

        </a>
    @endif

</td>
</tr>