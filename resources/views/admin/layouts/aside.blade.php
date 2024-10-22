@php
    try {
        $req_segments = explode('.', request()->route()->getName());
    } catch (\Throwable $th) {
        $req_segments = [];
    }
@endphp
<aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

    <ul class="list-reset flex flex-col">

        <li class=" w-full h-full py-3 px-2 border-b border-light-border {{ in_array('home', $req_segments)  ? 'bg-white' :'' }} ">
            <a href="{{ route('dashboard.home') }}"
                class="font-sans font-bold hover:text-[#52bcdc] text-sm text-nav-item no-underline">
                <span
                    class="flex grow items-center gap-2 {{ in_array('home', $req_segments)  ? '-translate-y-1 scale-110 text-[#52bcdc]' :'hover:-translate-y-1 hover:scale-110' }} transition ease-in-out delay-150  duration-300">
                    <object data="{{ asset('assets/images/icons/home.svg') }}" type="image/svg+xml" width="18"
                        height="100%"></object>
                    <span class="grow">{{ __('Dashboard') }}</span>
                </span>
            </a>
        </li>
        @canany([ 'admin.show', 'role.show'])
            
        
        <li class="h-full py-3 px-2 border-b border-light-border" aria-controls="dropdown-admins"
            data-collapse-toggle="dropdown-admins"
            aria-expanded="{{ in_array('admins', $req_segments) || in_array('roles', $req_segments) ? 'true' : 'false' }}">
            <a href="#"
                class="flex items-center  w-full font-sans font-bold hover:text-[#52bcdc] text-sm text-nav-item no-underline">
                <span
                    class="flex grow items-center gap-2 transition ease-in-out delay-150 {{ in_array('roles', $req_segments) || in_array('admins', $req_segments) ? '-translate-y-1 scale-110 text-[#52bcdc]' :'hover:-translate-y-1 hover:scale-110' }} duration-300">
                    <object data="{{ asset('assets/images/icons/admins-setting.svg') }}" type="image/svg+xml"
                        width="20" height="100%"></object>
                    <span class="grow">{{ __('Admins') }}</span>
                </span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4"></path>
                </svg>
            </a>
            <ul id="dropdown-admins"
                class="{{ in_array('admins', $req_segments) || in_array('roles', $req_segments) ? '' : 'hidden' }} py-2 space-y-2">
                @can("admin.show")
                <li class="h-full  py-3 px-2">
                    <a href="{{ route('dashboard.admins.index') }}"
                        class="flex items-center justify-between font-sans font-normal  text-sm text-nav-item no-underline">

                        <span
                            class="grow flex items-center gap-2 {{ in_array('admins', $req_segments)  ? '-translate-y-1 scale-110 text-[#52bcdc]' : 'hover:-translate-y-1 hover:scale-110'   }} transition ease-in-out delay-150  duration-300">
                            <object data="{{ asset('assets/images/icons/admin.svg') }}" type="image/svg+xml"
                                width="20" height="100%"></object>
                            <span class="grow">{{ __('Admins') }}</span>
                        </span>
                    </a>
                </li>
                @endcan
                @can('role.show')
                <li class="w-full h-full py-3 px-2">
                    <a href="{{ route('dashboard.roles.index') }}"
                        class="flex items-center justify-between w-full font-normal font-light text-sm text-nav-item no-underline">
                        <span
                            class="grow transition ease-in-out delay-150  {{ in_array('roles', $req_segments)  ? '-translate-y-1 scale-110 text-[#52bcdc]' :'hover:-translate-y-1 hover:scale-110' }} duration-300 flex items-center gap-2">
                            <object data="{{ asset('assets/images/icons/roles.svg') }}" type="image/svg+xml"
                                width="20" height="100%"></object>
                            <span class="grow">{{ __('Roles') }}</span>
                        </span>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany
        @canany([ 'customer.show', 'invoice.show'])
            
        
        <li class="h-full py-3 px-2 border-b border-light-border" aria-controls="dropdown-users"
            data-collapse-toggle="dropdown-users"
            aria-expanded="{{ in_array('customers', $req_segments) || in_array('invoices', $req_segments) ? 'true' : 'false' }}">
            <a href="#"
                class="flex items-center  w-full font-sans font-bold hover:text-[#52bcdc] text-sm text-nav-item no-underline">
                <span
                    class="flex grow items-center gap-2 transition ease-in-out delay-150 {{ in_array('customers', $req_segments) || in_array('invoices', $req_segments) ? '-translate-y-1 scale-110 text-[#52bcdc]' :'hover:-translate-y-1 hover:scale-110' }} duration-300">
                    <object data="{{ asset('assets/images/icons/user.svg') }}" type="image/svg+xml"
                        width="20" height="100%"></object>
                    <span class="grow">{{ __('Customers') }}</span>
                </span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4"></path>
                </svg>
            </a>
            <ul id="dropdown-users"
                class="{{ in_array('customers', $req_segments) || in_array('invoices', $req_segments) ? '' : 'hidden' }} py-2 space-y-2">
                @can("customer.show")
                <li class="h-full  py-3 px-2">
                    <a href="{{ route('dashboard.customers.index') }}"
                        class="flex items-center justify-between font-sans font-normal  text-sm text-nav-item no-underline">

                        <span
                            class="grow flex items-center gap-2 {{ in_array('customers', $req_segments)  ? '-translate-y-1 scale-110 text-[#52bcdc]' : 'hover:-translate-y-1 hover:scale-110'   }} transition ease-in-out delay-150  duration-300">
                            <object data="{{ asset('assets/images/icons/customer.svg') }}" type="image/svg+xml"
                                width="20" height="100%"></object>
                            <span class="grow">{{ __('Customers') }}</span>
                        </span>
                    </a>
                </li>
                @endcan
                @can('invoice.show')
                <li class="w-full h-full py-3 px-2">
                    <a href="{{ route('dashboard.invoices.index') }}"
                        class="flex items-center justify-between w-full font-normal font-light text-sm text-nav-item no-underline">
                        <span
                            class="grow transition ease-in-out delay-150  {{ in_array('invoices', $req_segments)  ? '-translate-y-1 scale-110 text-[#52bcdc]' :'hover:-translate-y-1 hover:scale-110' }} duration-300 flex items-center gap-2">
                            <object data="{{ asset('assets/images/icons/provider.svg') }}" type="image/svg+xml"
                                width="20" height="100%"></object>
                            <span class="grow">{{ __('invoices') }}</span>
                        </span>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany
    </ul>

</aside>
