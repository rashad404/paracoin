@extends('layouts.defaultView')

@section('content')
    <div class="box-container">
        <div>@lang('text.To receive Para you just need to give your Para address') {{$address ? '('.$address.')': ''}}</b> @lang('text.receive-end-text')</div>
        <div>@lang('text.Transactions are processed nearly instantly')</div>
    </div>
@stop
