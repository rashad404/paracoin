<!DOCTYPE html>
<html class="no_overflow">
<head lang="en">
    @include('includes.head')
</head>
<body>

@include('includes.flash_msg')


{{--@if(request()->route()->getName()!='about' && request()->route()->getName()!='blog')--}}

<div id="main">
    @yield('content')
</div>



    @include('includes.foot')
</body>
</html>
