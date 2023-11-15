@extends('layouts.defaultView')

@section('content')

    <div class ="flex flex-col max-w-sm">

        {{ Form::open(array('url' => config('coin.folder').'/send', 'method'=>'post')) }}

        <div class = "mb-4">
            <label for="email" class="sr-only">@lang('text.To')</label>
            {{Form::text('to', null, [
                'class'=>'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md', 
                'placeholder'=>__('text.To'), 
                'minlength' => 20,
                'maxlength' => 20,
                'required' => 'required'
                ] )}}
        </div>

        <div class = "mb-10">
            <label for="amount" class="block text-sm font-medium text-gray-700"></label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm"> P </span>
                </div>
                {{Form::text('amount', null, [
                    'class'=>'focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md', 
                    'placeholder'=>__('text.Amount'), 
                    'step' => '0.0000001', 
                    'min'=>1, 
                    'max'=>1000000,
                    'required' => 'required',
                    'id' => 'amount'
                    ] )}}
                <div class="absolute inset-y-0 right-0 flex items-center">
                <label for="currency" class="sr-only">{{config('coin.currency')}}</label>
                <select id="currency" name="currency" class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                    <option>{{config('coin.currency')}}</option>
                </select>
                </div>
            </div>
        </div>
    

        <div class = "mb-4">
            <label for="note" class="block text-sm font-medium text-gray-700"></label>
            <div class="mt-1">
                <textarea rows="4" name="note" id="note" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="@lang('text.Note')"></textarea>
            </div>
        </div>

        {{ Form::submit(__('text.Send'), ['class'=>'mb-4 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-100']) }}

        {{ Form::close() }}

    </div>

@stop
