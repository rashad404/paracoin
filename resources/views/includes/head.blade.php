<base href="/" />
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
<meta name="author" content="{{env('APP_NAME')}}">
<meta name="keywords" content="{{$meta['keywords']}}">
<meta name="description" content="{{$meta['description']}}">
<meta name="copyright" content="{{env('APP_NAME')}}" />

<meta property="og:title" content="{{$meta['title']}}">
<meta property="og:description" content="{{$meta['description']}}">
<meta property="og:image" content="{{asset('images/favicon/favicon-32x32.png')}}">

<meta property="og:url" content="https://{{$_SERVER['HTTP_HOST']}}{{$_SERVER['REQUEST_URI']}}">

<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

    <title>{{$meta['title']}}</title>
<?php
    $rand_css = rand(11111,99999);
    // $rand_css = 3;
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
{{-- <link rel="stylesheet" href="{{ asset('css/app.css?'.$rand_css)  }}"> --}}

<link rel="stylesheet" href="{{ asset('css/tailwind.css?'.$rand_css)  }}">
<link rel="stylesheet" href="{{ asset('css/output.css?'.$rand_css)  }}">
<link rel="stylesheet" href="https://rsms.me/inter/inter.css">
 <script src="https://kit.fontawesome.com/4967755b6e.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('js/app.js?'.$rand_css) }}"></script>

@stack('head')
