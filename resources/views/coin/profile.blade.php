@extends('layouts.default')

@section('content')

@include('includes.breadcrumbs')

    <section class="coin-section">
        &larr; <a href="{{config('coin.folder')}}/">@lang('text.Back')</a><br/>

        <h1 class="page-title">@lang('text.'.$pageTitle)</h1>
        <div>{{config('coin.symbol')}} address: <b>{{$address}}</b></div><br/>
        {{ Form::open(array('url' => config('coin.folder').'/profile', 'method'=>'post')) }}
            <div class="form-group">
                {{Form::text('name', $user_info->name, [
                    'class'=>'form-control', 
                    'placeholder'=>'Name', 
                    'maxlength' => 20
                    ] )}}
            </div>
            <div class="form-group">
                {{Form::text('email', $user_info->email, [
                    'class'=>'form-control', 
                    'placeholder'=>'E-mail', 
                    'maxlength' => 50
                    ] )}}
            </div>
            <div class="form-group">
                {{Form::text('phone', $user_info->phone, [
                    'class'=>'form-control', 
                    'placeholder'=>'Phone', 
                    'maxlength' => 15
                    ] )}}
            </div>
            <div class="form-group">
                {{Form::password('password', [
                    'class'=>'form-control', 
                    'placeholder'=>'Password', 
                    'maxlength' => 10,
                    'required' => 'required'
                    ] )}}
                    
            </div>
        {{ Form::submit(__('text.Update'), ['class'=>'btn btn-primary']) }}

        {{ Form::close() }}
        
    </section>

@stop
