<div class="m-5">

    <div class="flex flex-col items-center">
        <!-- Help text -->
        <span class="text-sm text-gray-700 dark:text-gray-400">
            الصفحة <span class="font-semibold text-gray-900 dark:text-white">
              {{$data->currentPage()	}}</span> من 
              <span class="font-semibold text-gray-900 dark:text-white">
                {{ (int) ($data->total()/$data->perPage() ) +1 }}</span>  لعدد
                <span class="font-semibold text-gray-900 dark:text-white">
                  {{$data->total()}}</span> صف
        </span>
        <div class="inline-flex mt-2 xs:mt-0">
          <!-- Buttons -->
          <button id="next_page"
          onclick="document.location.href='{{$data->nextPageUrl()	}}'"
          class="flex items-center justify-center px-4 h-10 text-base font-medium text-white rounded-s bg-gray-200 hover:bg-gray-500 text-gray-900 font-bold">
              <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
              </svg>
             {{__("messages.next")}} 
          </button>
          <button  id="prev_page"
                    onclick="document.location.href='{{$data->previousPageUrl()	}}'"

          class="flex items-center justify-center px-4 h-10 text-base font-medium border-0 border-s rounded-e bg-gray-200 hover:bg-gray-500 text-gray-900 font-bold">
             {{__("messages.prev")}} 
              <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
          </button>
        </div>
      </div>
</div>