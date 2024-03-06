@extends('layouts.defaultView')

@section('content')
    <div class="mb-8">@lang('text.We believe in transparency. What we do now and what we are planning for the future will always be transparent.')</div>
    <div class="flow-root">
        <ul role="list" class="pb-8 text-base">
            <li>
                <div class="relative pb-8">
                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                    <div class="relative flex space-x-3">
                        <div>
                            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white"> 
                                <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="min-w-0 flex flex-col flex-1 pt-1.5 justify-between space-x-4">
                            <div class="text-indigo-500 font-bold">Q1-Q2 2024</div>
                            <ul class="list-disc my-3">
                                <li>@lang('text.:coinName initial website launch', ['coinName' => config('coin.name')])</li>
                                <li>@lang('text.Buy :coinName with Cryptocurrencies', ['coinName' => config('coin.name')])</li>
                                <li>@lang('text.Website Builder Integration', ['coinName' => config('coin.name')])</li>
                                <li>@lang('text.Soccer Website Integration', ['coinName' => config('coin.name')])</li>
                                <li>@lang('text.UG Website Integration', ['coinName' => config('coin.name')])</li>

                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="relative pb-8">
                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                    <div class="relative flex space-x-3">
                        <div>
                            <span class="h-8 w-8 rounded-full bg-green-300 flex items-center justify-center ring-8 ring-white"> 
                                <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="min-w-0 flex flex-col flex-1 pt-1.5 justify-between space-x-4">
                            <div class="text-indigo-500 font-bold">Q3-Q4 2024</div>
                            <ul class="list-disc my-3">
                                <li>@lang('text.:coinName Checkout for Website/APPs', ['coinName' => config('coin.name')])</li>
                                <li>@lang('text.Money Transfer')</li>
                                <li>@lang('text.Smart Contracts')</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="relative pb-8">
                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                    <div class="relative flex space-x-3">
                        <div>
                            <span class="h-8 w-8 rounded-full bg-gray-500 flex items-center justify-center ring-8 ring-white"> 
                                <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="min-w-0 flex flex-col flex-1 pt-1.5 justify-between space-x-4">
                            <div class="text-indigo-500 font-bold">Q1-Q2 2025</div>
                            <ul class="list-disc my-3">
                                <li>@lang('text.Crypto Exchange')</li>
                                <li>@lang('text.Developer API')</li>
                                <li>@lang('text.NFT Marketplace')</li>
                                <li>@lang('text.Mobile App')</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </div>
@stop
