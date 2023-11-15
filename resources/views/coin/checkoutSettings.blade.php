@extends('layouts.defaultView')

@section('content')

    <div>@lang('text.Private Token'): <b>{{$checkoutSettings['privateToken']}}</b></div><br/>
    {{ Form::open(array('url' => config('coin.folder').'/checkout-settings', 'method'=>'post')) }}
        <div class="form-group">
            {{Form::text('resultUrl', $checkoutSettings['resultUrl'], [
                'class'=>'form-control', 
                'placeholder'=>'Result URL', 
                'maxlength' => 200
                ] )}}
        </div>
        <div class="form-group">
            {{Form::text('callbackUrl', $checkoutSettings['callbackUrl'], [
                'class'=>'form-control', 
                'placeholder'=>'Callback URL', 
                'maxlength' => 200
                ] )}}
        </div>
        <div class="sliderCheckBox">
            <label for="">@lang('text.Debug Mode'):</label>
            <label class="switch">
                <input name="debugMode" type="checkbox" {{$checkoutSettings['debugMode'] ? 'checked': ''}}>
                <span class="slider round"></span>
                </label>
        </div>
    {{ Form::submit(__('text.Update'), ['class'=>'btn btn-primary']) }}

    {{ Form::close() }}

@stop
