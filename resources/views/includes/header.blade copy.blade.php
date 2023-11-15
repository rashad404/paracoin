@php
    use App\Models\CoinAddress;
    $get_address = CoinAddress::getAddress();
    if($get_address){
        $address = $get_address['address'];
        $balance = $get_address['balance'];
    }else{
        $address = '';
    }
@endphp
    <section class="header" style="display: none">
        <div ref="allSite" class="all-site"></div>
        <section class="left-sidebar" >
            <div class="logo">
                <a id="index" href="{{config('coin.folder')}}/">
                    <div class="logo-icon">
                        <img src="{{asset('images/logo/paracoin-logo.png')}}" alt="{{config('coin.name')}}">
                    </div>
                    <div class="logo-text">{{config('coin.name')}}</div>
                </a>
            </div>
            <ul>
                {{-- @if (strlen($address)==config('coin.length')) --}}
                    <li><a href="{{config('coin.folder')}}/buy"><i class="fas fa-plus-square"></i> @lang('text.Buy') {{config('coin.symbol')}}</a></li>
                    <li><a href="{{config('coin.folder')}}/send"><i class="fas fa-exchange-alt"></i> @lang('text.Send') {{config('coin.symbol')}}</a></li>
                    <li><a href="{{config('coin.folder')}}/receive"><i class="fas fa-wallet"></i> @lang('text.Receive') {{config('coin.symbol')}}</a></li>
                    <li><a href="{{config('coin.folder')}}/user-transactions"><i class="fas fa-clipboard"></i> @lang('text.Your transactions')</a></li>
                {{-- @endif --}}
                <li><a href="{{config('coin.folder')}}/public-transactions"><i class="fas fa-clipboard-list"></i>@lang('text.All Public Transactions')</a></li>
                <li><a href="{{config('coin.folder')}}/white-paper"><i class="far fa-file-word"></i> {{config('coin.symbol')}} @lang('text.White Paper')</a></li>
                <li><a href="{{config('coin.folder')}}/stats"><i class="fas fa-chart-bar"></i> {{config('coin.symbol')}} @lang('text.Statistics')</a></li>
                <li><a href="{{config('coin.folder')}}/roadmap"><i class="fas fa-road"></i> {{config('coin.symbol')}} @lang('text.Roadmap')</a></li>
                <li><a href="{{config('coin.folder')}}/api"><i class="fas fa-code"></i> {{config('coin.symbol')}} @lang('text.Developer API')</a></li>
                <li><a href="{{config('coin.folder')}}/checkout-settings"><i class="fas fa-shopping-cart"></i>  @lang('text.Checkout Settings')</a></li>
                @if (strlen($address)==config('coin.length'))
                    <li><a href="{{config('coin.folder')}}/profile"><i class="fas fa-address-card"></i> @lang('text.Your profile')</a></li>
                    <li><a href="{{config('coin.folder')}}/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> @lang('text.Sign out')</a></li>
                @endif
            </ul>
        </section>
        <section class="header-top">
            <div class="top-links">
                <div style="flex: 1" class="mobile_menu_icon"><i class="fas fa-bars"></i> @lang('text.Menu')</div>

                <div style="flex: 6;text-align:right;" class="header-right-block">

                    @if (strlen($address)==config('coin.length'))
                        <div style="display: flex">
                            <div style="flex: 2;padding-right:5px;">
                                <i class="fas fa-address-card"></i><br/>
                                <i class="fas fa-coins"></i>
                            </div>
                            <div style="width:200px;text-align:left;">
                                {{$address}}<br/>
                                <span style="color:red;">{{$balance}} {{config('coin.symbol')}}</span>
                            </div>
                            <div style="width:90px;">
                                <a href="{{config('coin.folder')}}/logout" class="btn btn-outline-secondary">@lang('text.Sign out')</a>
                            </div>
                        </div>
                    @else
                        <a href="{{config('coin.folder')}}/login" class="btn btn-outline-secondary">@lang('text.Login')</a>
                        <a href="{{config('coin.folder')}}/create-address" class="btn btn-primary">@lang('text.Create Address')</a>    
                    @endif
                </div>
                
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{config('coin.folder')}}/">Main</a></li>
                    {{-- <li class="breadcrumb-item"><a href="my-admin#/blog">Blog</a></li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </section>
    </section>