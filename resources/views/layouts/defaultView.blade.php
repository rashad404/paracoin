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

    <section class="m-6 sm:m-8 bg-white">
        <div class="mx-auto py-12 px-4 max-w-7xl sm:px-6 lg:px-8">
            @include('includes.breadcrumbs')
            
            <div class="mb-4 mt-3 md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-xl font-semibold text-gray-900">@lang('text.'.$pageTitle)</h1>
                </div>
            </div>
            @yield('content')
        </div>
    </section>
</div>



    @include('includes.foot')
    @include('includes.footer')
</body>
</html>
