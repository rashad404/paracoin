@extends('layouts.defaultView')

@section('content')
    @if (count($list)>0)
        <div class="flex justify-end">
            <a href="/send" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">@lang('text.Send Para')</a>
        </div>
        <div class="my-8 flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full py-2 align-middle">
                    <div class="overflow-hidden ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">@lang('text.From')</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">@lang('text.To')</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">@lang('text.Amount')</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($list as $item)
                                <tr class="hover:bg-gray-100 {{($loop->iteration % 2 == 0) ? 'bg-gray-50' : ''}}">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">#{{$item->id}}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$item->from}}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$item->to}}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$item->amount}} {{config('coin.symbol')}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="box-container">@lang('text.No transactions yet')</div>
    @endif

@stop
