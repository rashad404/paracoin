@extends('checkout.includes.default')

@section('content')

    <div class="centerBox">
        <h1>{{config('coin.symbol')}} @lang('text.Checkout')</h1>
        <div class="logo"><img src="images/logo/paracoin-logo.png" alt="Logo"/></div>
        {{-- <div class="logo"><img src="images/partner-logos/amazon-logo.png" alt="Logo"/></div> --}}
        @if ($errors->any())
            <div class="alert {{$errors->has('success') ? 'alert-success':'alert-danger'}}">
                @foreach ($errors->all() as $error)
                <div>- {!! $error !!}</div>
                @endforeach
            </div>
            <div style="text-align: center">&larr; <a href="/checkout">@lang('text.Back')</a></div>
        @else
            {{ Form::open(array('url' => config('coin.folder').'/checkout/pay', 'method'=>'post')) }}
            @if ($address)
            <div class="paymentInfo"><span class="infoTitle">@lang('text.Your Account'):</span> {{$address}}</div>
            <div class="paymentInfo"><span class="infoTitle">@lang('text.Your Balance'):</span> 
                {!! $balance < $amount ? "<span style='color:red;'>!</span>" : '' !!}  {{$balance}} {{config('coin.symbol')}}
                <a href="/buy" target="_blank">@lang('text.Buy')</a>
            </div>
            @endif
                <div class="paymentInfo"><span class="infoTitle">@lang('text.Payment for'):</span> {{$info}}</div>
                <div class="paymentInfo"><span class="infoTitle">@lang('text.Receiver'):</span> {{$receiver}}</div>
                <div class="paymentInfo"><span class="infoTitle">@lang('text.Amount'):</span>
                    <div class="inputBox customInput">
                        <div class="amount">
                            @if (!$customAmount)
                                {{$amount}}
                            @else
                                {{Form::number('amount', 0, [
                                    'placeholder'=>__('text.Amount'), 
                                    'step' => '0.0000001', 
                                    'min'=>1, 
                                    'max'=>1000000,
                                    'required' => 'required'
                                    ] )}}
                            @endif
                            <span class="symbol">{{config('coin.symbol')}}</span>
                        </div>
                    </div>
                        {{-- <div class="inputBox">
                            {{Form::text('note', null, [
                                'class'=>'form-control', 
                                'placeholder'=>__('text.Note'), 
                                'required' => 'required'
                                ] )}}   
                        </div> --}}

                </div>
                {{Form::hidden('confirm', 1)}}

                <div class="submit">
                    {{ Form::submit(__('text.Pay'), ['class'=>'submit']) }}
                </div>
                <div class="note">
                    * Please carefully review the payment information and amount before submitting.<br/>
                </div>

            {{ Form::close() }}

        @endif
        <div class="footer">
            © <a href="" target="_blank">{{config('coin.websiteName')}}</a>
        </div>
        
    </div>

@stop
