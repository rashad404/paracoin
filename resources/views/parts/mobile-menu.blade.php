<div class="mobileMenu absolute hidden top-0 inset-x-0 z-10 p-2 transition transform origin-top-right md:hidden">
    <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
        <div class="pt-5 pb-6 px-5">
                
            <div class="flex items-center justify-between">
                <div>
                <img class="h-8 w-auto" src="{{asset('images/logo/paracoin-logo.png')}}" alt="{{config('coin.name')}}">
                </div>
                <div class="-mr-2">
                <button type="button" class="mobileMenuClose bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="sr-only">Close menu</span>
                    <!-- Heroicon name: outline/x -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                </div>
            </div>

            <div class="mt-6">
                <nav class="grid gap-y-8">
                    @foreach($menus as $menu)
                        @if($menu->childmenu->count() > 0)
                            
                            <a href="{{$menu->url}}" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50 {{(request()->path() == $menu->url) ? 'active': ''}}">
                                <i class="{{ $menu->icon }} text-2xl text-indigo-600 h-5 w-6"></i>
                                <span class="ml-3 text-base font-medium text-gray-900"> @lang('text.' . $menu->name) </span>
                            </a>
                            <div class="grid grid-cols-1 gap-y-4 gap-x-8">
                                @foreach($menu->childmenu as $submenu)
                                <span class="ml-10">
                                    <a href="{{$submenu->url}}" class="text-base font-medium text-gray-900 hover:text-gray-700"> @lang('text.' . $submenu->name) </a>
                                </span>
                                @endforeach
                            </div>
                        @else
                            <a href="{{$menu->url}}" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50 {{(request()->path() == $menu->url) ? 'active': ''}}">
                                <i class="{{ $menu->icon }} text-2xl flex-shrink-0 h-6 w-6 text-indigo-600"></i>
                                <span class="ml-3 text-base font-medium text-gray-900"> @lang('text.' . $menu->name) </span>
                            </a>
                        @endif
                    @endforeach


                </nav>
            </div>
        </div>
        <div class="py-6 px-5 space-y-6">
            <div>
                <a href="/create-address" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"> @lang('text.Sign up') </a>
                <p class="mt-6 text-center text-base font-medium text-gray-500">
                @lang('text.Existing customer?')
                <a href="/login" class="text-indigo-600 hover:text-indigo-500"> @lang('text.Sign in') </a>
                </p>
            </div>
        </div>
    </div>
</div>