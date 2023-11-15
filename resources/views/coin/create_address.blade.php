@extends('layouts.defaultView')

@section('content')

    <div><span style="color:red;">@lang('text.Attention')!</span> @lang('text.Please copy/save your address and password, you will not be able to see the password after page refresh.')</div>
    <br/>
    <div>@lang('text.Your :coinSymbol address', ['coinSymbol' => config('coin.symbol')]): <b>{{$address}}</b></div>    
    <div>@lang('text.Your :coinSymbol password', ['coinSymbol' => config('coin.symbol')]): <b>{{$password}}</b></div>
    <br/>  
    <div>
        <a class="btn btn-primary" href="{{config('coin.folder')}}">@lang('text.Continue')</a> 
        <a class="btn btn-outline-secondary" href="{{config('coin.folder')}}/logout">@lang('text.Sign out')</a>
    </div>
@stop
