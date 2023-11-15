@php
    use App\Models\CoinAddress;
    use App\Models\Menu;
    $get_address = CoinAddress::getAddress();
    if($get_address){
        $address = $get_address['address'];
        $balance = $get_address['balance'];
    }else{
        $address = '';
    }

    $menus = Menu::getList();
@endphp

  <div class="relative bg-gray-50" id="header">
      <div class="relative bg-white shadow">
          <div class="max-w-7xl mx-auto px-4 sm:px-6">
              <div class="flex justify-between items-center py-6 md:justify-start md:space-x-10">
                  <div class="flex justify-start lg:w-0 lg:flex-1">
                    <a href="{{config('coin.folder')}}/">
                        <span class="sr-only">{{config('coin.name')}}</span>
                        <img class="h-8 w-auto sm:h-10" src="{{asset('images/logo/paracoin-logo.png')}}" alt="{{config('coin.name')}}">
                    </a>
                  </div>
                  <nav class="hidden md:flex space-x-10">
                    @if (strlen($address) == config('coin.length'))
                      @include('parts.user-menus')
                    @else
                      @include('parts.menus')
                    @endif
                  </nav>

                  <div class="flex flex-row items-center">
                    @include('parts.language')

                    <div class="-mr-2 -my-2 md:hidden">
                      <button type="button" class="mobileMenuOpen bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false">
                          <span class="sr-only">Open menu</span>
                          <!-- Heroicon name: outline/menu -->
                          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                          </svg>
                      </button>
                    </div>
                </div>

                <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                  @if (strlen($address) == config('coin.length'))

                      <button type="button" class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: outline/bell -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                      </button>

                      <!-- Profile dropdown -->
                      <div class="ml-3 relative">
                        <div>
                          <button type="button" class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                          </button>
                        </div>

                        <div id="user-menu" class="z-50 hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                          <a href="/logout" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">@lang('text.Sign out')</a>
                        </div>
                      </div>
                  @else
                      @if (strlen($address) == config('coin.length'))
                          <div style="width:200px;text-align:left;">
                              {{$address}}<br/>
                              <span style="color:red;">{{$balance}} {{config('coin.symbol')}}</span>
                          </div>
                          <a href="/logout" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"> @lang('text.Sign out')</a>
                      @else
                          <a href="/login" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"> @lang('text.Sign in') </a>
                          <a href="/create-address" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"> @lang('text.Sign up') </a>
                      @endif
                    </div>
                  @endif
                </div>

              </div>
          </div>

          @include('parts.mobile-menu')
      </div>
  </div>