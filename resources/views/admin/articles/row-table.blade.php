<tr id="row-table-{{ $article->id }}"
    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">

    <td class="px-6 py-4 ">
        {{ __('messages.' . $article->lang) }}
    </td>
    <td class="px-6 py-4 ">
        {{ $article->title }}
    </td>
    <td class="px-6 py-4 image-container">
        <div class="flex gap-2">
            <div href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                <img src="{{ $article->image }}" alt="" srcset="">
            </div>

        </div>
    </td>
    <th class="px-6 py-4 ">
        {{ $article->category?->name }}
    </th>
    <td class="px-6 py-4">
        @if ($article->active)
            <span
                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ __('messages.Active') }}</span>
        @else
            <span
                class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ __('messages.unactive') }}</span>
        @endif
    </td>

    <td class="px-6 py-4">
        @if ($article->special)
            <span
                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ __('blog::messages.special') }}</span>
        @else
            <span
                class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ __('blog::messages.unspecial') }}</span>
        @endif
    </td>
    <td class="px-6 py-4 image-container">
        <div class="flex gap-2">
            @if ($article->active)
                <a href="#" title="{{ __('messages.action unactive article') }}"
                    data-action="{{ route('dashboard.blog.articles.unactive', $article->id) }}"
                    data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                    class="modal-popup font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    <img src="{{ asset('assets/images/remove.png') }}" alt="" srcset="">
                </a>
            @else
                <a href="#" title="{{ __('messages.action active article') }}"
                    data-action="{{ route('dashboard.blog.articles.active', $article->id) }}"
                    data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                    class="modal-popup font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    <img src="{{ asset('assets/images/check-mark.png') }}" alt="" srcset="">

                </a>
            @endif


            <a  href="{{ route('dashboard.blog.articles.edit', $article->id) }}"
                 type="button">
                <img src="{{ asset('assets/images/sign-document-icon.svg') }}" alt="" srcset="">
            </a>
            <a href="#" title="{{ __('messages.action delete article') }}"
                data-action="{{ route('dashboard.blog.articles.destroy', $article->id) }}"
                data-method="DELETE"
                data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                class="modal-popup font-medium text-blue-600 dark:text-blue-500 hover:underline">
                <img src="{{ asset('assets/images/garbage-bin-10425.svg') }}" alt="" srcset="">
            </a>
        </div>
    </td>
</tr>
