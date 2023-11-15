<!DOCTYPE html>
<html class="no_overflow">
<head lang="en">
    @include('includes.head')
    @stack('extra-scripts')
</head>
<body>

@include('includes.header')
@include('includes.flash_msg')


{{--@if(request()->route()->getName()!='about' && request()->route()->getName()!='blog')--}}

<div id="main">
    @yield('content')
</div>



    @include('includes.foot')
    @include('includes.footer')
</body>
</html>
