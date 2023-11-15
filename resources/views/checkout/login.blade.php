@extends('checkout.includes.default')

@section('content')

    <div class="centerBox">
        <h1>{{config('coin.symbol')}} @lang('text.Checkout')</h1>
        <div class="coinLogo"><img src="images/logo/paracoin-logo.png" alt="Logo"/></div>
        @if ($errors->any())
            <div class="alert {{$errors->has('success') ? 'alert-success':'alert-danger'}}">
                @foreach ($errors->all() as $error)
                <div>- {{ $error }}</div>
                @endforeach
            </div>
            <div style="text-align: center">&larr; <a href="javascript:history.back()">@lang('text.Back')</a></div>
            
        @else
        
            {{ Form::open(array('url' => config('coin.folder').'/checkout/login', 'method'=>'post')) }}
                <div class="customInput">
                    {{Form::text('address', null, [
                        'placeholder'=>'Your Address', 
                        'maxlength' => 20,
                        'required' => 'required'
                        ] )}}
                </div>
                <div class="customInput">
                    {{Form::password('password', [
                        'placeholder'=>'Your password', 
                        'maxlength' => 40,
                        'required' => 'required'
                        ] )}}
                        
                </div>

                <div class="submit">
                    {{ Form::submit(__('text.Login'), ['class'=>'btn btn-primary']) }}
                </div>
                <div class="create-address">
                    <a target="_blank" href="/create-address" class="btn btn-secondary">@lang('text.Create Address')</a>
                </div>

            {{ Form::close() }}

        @endif
        <div class="footer">
            © <a href="" target="_blank">{{config('coin.websiteName')}}</a>
        </div>
        
    </div>

@stop
