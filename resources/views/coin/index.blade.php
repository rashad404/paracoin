@extends('layouts.default')

@section('content')

@include('parts.hero')
<br/>
    <section class="coin-section">
        <div class="bg-white">
            <div class="mx-auto py-12 px-4 max-w-7xl sm:px-6 lg:px-8 lg:py-24">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats_box">
                            <div class="title">@lang('text.Current Price')</div>
                            <div class="text">{{number_format($info->currentPrice, 6)}} {{config('coin.currency')}}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stats_box">
                            <div class="title">@lang('text.Max Supply')</div>
                            <div class="text">{{number_format($info->maxSupply, 0)}} {{config('coin.symbol')}}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stats_box">
                            <div class="title">@lang('text.Circulating Supply')</div>
                            <div class="text">{{number_format($info->circulatingSupply,0)}} {{config('coin.symbol')}}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="stats_box">
                            <div class="title">@lang('text.Market Cap')</div>
                            <div class="text">{{number_format($market_cap, 0)}} {{config('coin.currency')}}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="stats_box">
                            <div class="title">@lang('text.24 Hour Volume')</div>
                            <div class="text">{{number_format($volume_24_hour, 0)}} {{config('coin.symbol')}} ({{number_format($volume_24_hour_currency, 0)}} {{config('coin.currency')}})</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stats_box">
                            <div class="title">@lang('text.30 Day Volume')</div>
                            <div class="text">{{number_format($volume_30_day, 0)}} {{config('coin.symbol')}} ({{number_format($volume_30_day_currency, 0)}} {{config('coin.currency')}})</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="stats_box">
                            <div class="title">@lang('text.Total Addresses')</div>
                            <div class="text">{{$total_addresses}}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="stats_box">
                            <div class="title">@lang('text.Active Addresses')</div>
                            <div class="text">{{$total_active_addresses}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        @include('parts.stats')<br/>
        @include('parts.feature')<br/>
        {{-- @include('parts.feature2')<br/> --}}
        @include('parts.team')<br/>
        {{-- @include('parts.testimonials')<br/> --}}
        @include('parts.faq')<br/>
        {{-- @include('parts.join-team')<br/> --}}
        @include('parts.subscribe')<br/>
        @include('parts.logo-cloud')<br/>
        <div class="bg-white">
            <div class="mx-auto py-12 px-4 max-w-7xl sm:px-6 lg:px-8 lg:py-24">
                <canvas id="priceChart"  width="100"></canvas>
            </div>
            <br/><br/>
        </div>
    </section>


    @push('head')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const labels = @json($coinStatsArchive['period']);
            const data = {
                labels: labels,
                datasets: [{
                    label: 'Para Price',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: @json($coinStatsArchive['price']),
                }]
            };
            const config = {
                type: 'line',
                data: data,
                options: {
                    locale: 'en-IN',
                    scales: {
                        y: {
                            ticks: {
                                callback: (value, index, values) => {
                                    return '$'+value;
                                }
                            }
                        },
                        // x: {
                        //     ticks: {
                        //         callback: (value, index, values) => {
                        //             return '';
                        //         }
                        //     }
                        // }
                    }
                    
                }
            };
            window.onload = function () {
                const myChart = new Chart(
                    document.getElementById('priceChart'),
                    config
                );
            }
        </script>
    @endpush
@stop
