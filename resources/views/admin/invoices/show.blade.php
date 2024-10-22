<!-- Modal -->
@extends('admin.layouts.master')

@section('title')
    {{ __('invoices') }}
@endsection
@section("js")
<script>
    function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head>'+document.getElementsByTagName("head")[0].innerHTML +'</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    // mywindow.print();
    // mywindow.close();

    return true;
}
</script>
@endsection
@section('content')
    @php
        $nav_items = [['title' => __('Invoices'), 'href' => route('dashboard.invoices.index')]];
    @endphp
    @component('components.breadcrump', ['nav_items' => $nav_items])
    @endcomponent
    <div id="invoice-content"
        class="relative flex flex-col bg-white shadow-lg rounded-xl pointer-events-auto dark:bg-gray-800">
        <div class="relative overflow-hidden min-h-[8rem] bg-gray-900 text-center rounded-t-xl">
            <!-- Close Button -->

            <!-- End Close Button -->

            <!-- SVG Background Element -->
            <figure class="absolute inset-x-0 bottom-0 -mb-px">
                <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1920 100.1">
                    <path fill="currentColor" class="fill-white dark:fill-gray-800"
                        d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"></path>
                </svg>
            </figure>
            <!-- End SVG Background Element -->
        </div>

        <div class="relative z-10 -mt-12">
            <!-- Icon -->
            <span
                class="mx-auto flex justify-center items-center w-[62px] h-[62px] rounded-full border border-gray-200 bg-white text-gray-700 shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                <svg class="flex-shrink-0 w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                    <path
                        d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                </svg>
            </span>
            <!-- End Icon -->
        </div>

        <!-- Body -->






        <div class="p-4 sm:p-7 overflow-y-auto">
            <div class="text-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                    {{ __('Invoice from') }} {{ config('app.name') }}
                </h3>
                <p class="text-sm text-gray-500">
                    {{ __('Invoice') }} #{{ $invoice->number }}
                </p>
            </div>

            <!-- Grid -->
            <div class="mt-5 sm:mt-10 grid grid-cols-2 sm:grid-cols-3 gap-5">
                <div>
                    <span class="block text-xs uppercase text-gray-500">{{ __('invoice Amount paid') }}:</span>
                    <span class="block text-sm font-medium text-gray-800 dark:text-gray-200">$
                        {{ $invoice->total_amount }}</span>
                </div>
                <!-- End Col -->

                <div>
                    <span class="block text-xs uppercase text-gray-500">{{ __('invoice Date') }}:</span>
                    <span class="block text-sm font-medium text-gray-800 dark:text-gray-200">{{ $invoice->date }}</span>
                </div>
                <!-- End Col -->

                <div>
                    <span class="block text-xs uppercase text-gray-500">{{ __('invoice Payment method') }}:</span>
                    <div class="flex items-center gap-x-2">
                        <svg class="w-5 h-5" width="400" height="248" viewBox="0 0 400 248" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0)">
                                <path d="M254 220.8H146V26.4H254V220.8Z" fill="#FF5F00" />
                                <path
                                    d="M152.8 123.6C152.8 84.2 171.2 49 200 26.4C178.2 9.2 151.4 0 123.6 0C55.4 0 0 55.4 0 123.6C0 191.8 55.4 247.2 123.6 247.2C151.4 247.2 178.2 238 200 220.8C171.2 198.2 152.8 163 152.8 123.6Z"
                                    fill="#EB001B" />
                                <path
                                    d="M400 123.6C400 191.8 344.6 247.2 276.4 247.2C248.6 247.2 221.8 238 200 220.8C228.8 198.2 247.2 163 247.2 123.6C247.2 84.2 228.8 49 200 26.4C221.8 9.2 248.6 0 276.4 0C344.6 0 400 55.4 400 123.6Z"
                                    fill="#F79E1B" />
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="400" height="247.2" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span class="block text-sm font-medium text-gray-800 dark:text-gray-200">••••
                            {{ substr(45748748748748, 0, 4) }}</span>
                    </div>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Grid -->








            <!-- Grid -->
            <div class="grid md:grid-cols-2 gap-3 mt-10">
                <div>
                    <div class="grid space-y-3">

                        <dl class="grid sm:flex gap-x-3 text-sm">
                            <dt class="min-w-[150px] max-w-[200px] text-gray-500">
                                {{ __('billing full name') }}
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200">
                                {{ $invoice->client->name }}

                            </dd>
                        </dl>
                        <dl class="grid sm:flex gap-x-3 text-sm">
                            <dt class="min-w-[150px] max-w-[200px] text-gray-500">
                                {{ __('billing email') }}
                            </dt>
                            <dd class="text-gray-800 dark:text-gray-200">
                                <a class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline font-medium"
                                    href="#">
                                    {{ $invoice->client->email }}
                                </a>
                            </dd>
                        </dl>
                        <dl class="grid sm:flex gap-x-3 text-sm">
                            <dt class="min-w-[150px] max-w-[200px] text-gray-500">
                                {{ __('billing mobile') }}
                            </dt>
                            <dd class="text-gray-800 dark:text-gray-200">
                                <a class="inline-flex items-center gap-x-1.5  decoration-2 hover:underline font-medium">

                                    {{ $invoice->client->phone }}
                                </a>
                            </dd>
                        </dl>



                    </div>
                </div>
                <!-- Col -->

                <div>
                    <div class="grid space-y-3">
                        <dl class="grid sm:flex gap-x-3 text-sm">
                            <dt class="min-w-[150px] max-w-[200px] text-gray-500">
                                {{ __('Shipping details') }}:
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200">

                                <address class="not-italic font-normal">
                                    {{ $invoice->client->address }}
                                </address>
                            </dd>
                        </dl>
                    </div>
                </div>
                <!-- Col -->
            </div>
            <!-- End Grid -->












            @foreach ($invoice->items as $item)
                <div class="mt-5 sm:mt-10">
                    <h4 class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">
                        {{ $item['description']  }}</h4>
                    <ul class="mt-3 flex flex-col">

                        <li
                            class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-gray-700 dark:text-gray-200">
                            <div class="flex items-center justify-between w-full">
                                <span>{{ __('Price Per Item') }}</span>
                                <span>$ {{ $item['price'] }}</span>
                            </div>
                        </li>
                        <li
                            class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-gray-700 dark:text-gray-200">
                            <div class="flex items-center justify-between w-full">
                                <span>{{ __('Quantity') }}</span>
                                <span>{{ $item['quantity'] }}</span>
                            </div>
                        </li>
                        <li
                            class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-semibold bg-gray-50 border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-slate-800 dark:border-gray-700 dark:text-gray-200">
                            <div class="flex items-center justify-between w-full">
                                <span>{{ __('invoice Amount paid') }}</span>
                                <span>$ {{ (int) $item['price'] * (int) $item['quantity'] }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            @endforeach

            <!-- Button -->
            <div class="mt-5 flex justify-end gap-x-2 noprint">
                {{-- <a class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800"
                href="#" onclick="PrintElem('invoice-content','pdf')">
                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="7 10 12 15 17 10" />
                    <line x1="12" x2="12" y1="15" y2="3" />
                </svg>
                Invoice PDF
            </a> --}}
                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    href="#" onclick="PrintElem('invoice-content')">
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="6 9 6 2 18 2 18 9" />
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                        <rect width="12" height="8" x="6" y="14" />
                    </svg>
                    {{ __('Print') }}
                </a>
            </div>
            <!-- End Buttons -->
            {{-- 
        <div class="mt-5 sm:mt-10">
            <p class="text-sm text-gray-500">If you have any questions, please contact us at <a
                    class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline font-medium"
                    href="#">example@site.com</a> or call at <a
                    class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline font-medium"
                    href="tel:+1898345492">+1 898-34-5492</a></p>
        </div> --}}
        </div>
        <!-- End Body -->
    </div>
@endsection
