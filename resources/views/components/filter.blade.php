<div id="accordion-collapse" class="my-2 bg-white rounded" data-accordion="collapse">
    <h2 id="accordion-collapse-heading-3">
      <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-3" aria-expanded="false" aria-controls="accordion-collapse-body-3">
        <span>{{__("filter")}}</span>
        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
        </svg>
      </button>
    </h2>

    <div id="accordion-collapse-body-3" class="hidden rounded" aria-labelledby="accordion-collapse-heading-3">
        <form action="" method="get">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-4 m-5">
                @if ($wihtText ?? true)
                <div class="mb-5">
                  <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                      {{__("keyword")}}</label>
                  <input value="{{request("keyword")}}" name="keyword" type="text" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="{{__("keyword")}}" >
              </div>
                @endif

                {{$slot}}
            </div>
            <div class="text-center">
              <button class="bg-transparent hover:bg-blue-500 text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded">
                {{__("search")}}
            </button>
                
            </div>

        </form>

    </div>
  </div>
