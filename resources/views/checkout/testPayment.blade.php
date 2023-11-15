@extends('checkout.includes.default')

@section('content')

    <div class="centerBox">
        <h1>{{config('coin.symbol')}} @lang('text.Checkout')</h1>
        <div class="logo"><img src="images/partner-logos/amazon-logo.png" alt="Logo"/></div>
        {{ Form::open(array('url' => config('coin.folder').'/checkout')) }}
            <div class="paymentInfo"><span class="infoTitle">@lang('text.Amount'):</span>
                <div class="inputBox customInput">
                    <div class="amount">

                            {{Form::number('amount', 0, [
                                'placeholder'=>__('text.Amount'), 
                                'step' => '0.0000001', 
                                'min'=>1, 
                                'max'=>1000000,
                                'required' => 'required'
                                ] )}}
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
            {{Form::hidden('receiver', $receiver)}}
            {{Form::hidden('orderToken', $orderToken)}}
            {{Form::hidden('info', $info)}}
            {{Form::hidden('customAmount', 0)}}

            <div class="submit">
                {{ Form::submit(__('text.Pay'), ['class'=>'submit']) }}
            </div>
            <div class="note">
                * Please carefully review the payment information and amount before submitting.<br/>
            </div>

        {{ Form::close() }}
        <div class="footer">
            © <a href="" target="_blank">{{config('coin.websiteName')}}</a>
        </div>
        
    </div>

@stop
