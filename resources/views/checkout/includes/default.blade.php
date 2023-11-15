<!DOCTYPE html>
<html class="no_overflow">
<head lang="en">
    @include('checkout.includes.head')
</head>
<body>

{{-- @include('checkout.includes.flash_msg') --}}


{{--@if(request()->route()->getName()!='about' && request()->route()->getName()!='blog')--}}

<div id="main">
    @yield('content')
</div>



    @include('checkout.includes.foot')
    @include('checkout.includes.footer')
</body>
</html>
