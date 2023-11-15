@php
    $menus = [
        ['url' => '', 'name' => 'Dashboard'],
        ['url' => 'buy', 'name' => 'Buy Para'],
        ['url' => 'send', 'name' => 'Send Para'],
        ['url' => 'user-transactions', 'name' => 'Your Transactions'],
    ];
    $menus = json_decode(json_encode($menus), FALSE);
@endphp
@foreach($menus as $menu)
    <a class="text-base font-medium text-gray-500 hover:text-gray-900 {{(request()->path() == $menu->url) ? 'active': ''}}" href="/{{ $menu->url }}">@lang('text.' . $menu->name)</a>
@endforeach