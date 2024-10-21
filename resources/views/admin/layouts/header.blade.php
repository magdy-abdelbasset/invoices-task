<header class="bg-nav">
    <div class="flex justify-between">
        <div class="logo-head p-1 mx-3 inline-flex gap-4 items-center">

            <div class=" cursor-pointer" onclick="Dashboard.sidebarToggle()">

                <object data="{{ asset('assets/images/icons/menu-lite.svg') }}"
                    type="image/svg+xml" width="20" height="100%"></object>
            </div>
            <a class="logo" href="{{ route('dashboard.home') }}">

                <img class="logo-img" src="{{ asset('assets/images/logo-vertical.png') }}" alt="" srcset="">
            </a>
        </div>
        <div class="p-1 flex flex-row items-center">
            <a href="{{env("USER_WEB","#")}}"
                class="text-white p-2 mr-2 no-underline hidden md:block lg:block">{{__("User Website")}}</a>


            <img onclick="Dashboard.profileToggle()" class="inline-block h-8 w-8 rounded-full"
                src="{{auth()->user()->image}}" alt="">
            <a href="#" onclick="Dashboard.profileToggle()"
                class="text-white p-2 no-underline hidden md:block lg:block">{{auth()->user()->full_name ?? 'Admin'}}</a>
            <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                <ul class="list-reset">
                    <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">My
                            account</a></li>
                    <li><a href="#"
                            class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Notifications</a>
                    </li>
                    <li>
                        <hr class="border-t mx-2 border-grey-ligght">
                    </li>
                    <li><a href="{{route("dashboard.logout")}}" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">{{__("Logout")}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
