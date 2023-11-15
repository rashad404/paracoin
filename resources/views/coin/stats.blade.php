@extends('layouts.default')

@section('content')

    <section class="coin-section">
        <div class="mt-4">
            @include('includes.breadcrumbs')
        </div>
        <div class="mb-4 mt-3 md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-xl font-semibold text-gray-900">@lang('text.'.$pageTitle)</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="stats_box">
                    <div class="title">Max Supply</div>
                    <div class="text">{{number_format($info->maxSupply, 0)}} {{config('coin.symbol')}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats_box">
                    <div class="title">Circulating Supply</div>
                    <div class="text">{{number_format($info->circulatingSupply,0)}} {{config('coin.symbol')}}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stats_box">
                    <div class="title">Market Cap</div>
                    <div class="text">{{number_format($market_cap, 0)}} {{config('coin.currency')}}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stats_box">
                    <div class="title">24 Hour Volume</div>
                    <div class="text">{{number_format($volume_24, 0)}} {{config('coin.symbol')}} ({{number_format($volume_24_currency, 0)}} {{config('coin.currency')}})</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stats_box">
                    <div class="title">Total Addresses</div>
                    <div class="text">{{$total_addresses}}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stats_box">
                    <div class="title">Active Addresses</div>
                    <div class="text">{{$total_active_addresses}}</div>
                </div>
            </div>

        </div>
    </section>

@stop
