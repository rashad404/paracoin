@foreach($menus as $menu)
    @if($menu->childmenu->count() > 0)
        <div class="relative menuToggle" data-id="{{$menu->id}}">
            <!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
            <button type="button" class="text-gray-500 group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-expanded="false">
                <span>@lang('text.' . $menu->name)</span>
                <svg class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>

            <div id="subMenu-{{$menu->id}}" class="subMenu hidden absolute -ml-4 mt-3 transform z-10 px-2 w-screen max-w-md sm:px-0 lg:ml-0 lg:left-1/2 lg:-translate-x-1/2">
                <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                    <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">

                        @foreach ($menu->childmenu as $submenu)
                            <a href="/{{ $submenu->url }}" class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50 hover:no-underline">
                                <i class="{{ $submenu->icon }} text-2xl text-indigo-600 h-5 w-6"></i>

                                <div class="ml-4">
                                    <p class="text-base font-medium text-gray-900">@lang('text.' . $submenu->name)</p>
                                    <p class="mt-1 text-sm text-gray-500">@lang('text.' . $submenu->description)</p>
                                </div>
                            </a>
                        @endforeach

                    </div>
                    <div class="px-5 py-5 bg-gray-50 space-y-6 sm:flex sm:space-y-0 sm:space-x-10 sm:px-8">
                        <div class="flow-root">
                            <a href="/create-address" class="-m-3 p-3 flex items-center rounded-md text-base font-medium text-gray-900 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span class="ml-3">@lang('text.Get Started')</span>
                            </a>
                        </div>

                        <div class="flow-root">
                            <a href="/contact" class="-m-3 p-3 flex items-center rounded-md text-base font-medium text-gray-900 hover:bg-gray-100">
                            <!-- Heroicon name: outline/phone -->
                            <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="ml-3">@lang('text.Contact Us')</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <a class="text-base font-medium text-gray-500 hover:text-gray-900 {{(request()->path() == $menu->url) ? 'active': ''}}" href="/{{ $menu->url }}">@lang('text.' . $menu->name)</a>
    @endif
@endforeach