@extends('layouts.defaultView')

@section('content')

        <p>
            <div>
                <h2 class="text-xl font-bold text-gray-900">@lang('text.Checkout')</h2>
                <p class="mt-2 mb-4 text-lg text-gray-500">@lang('text.Checkout API helps merchants accept payment with :coinName', ['coinName' => config('coin.name')]).</p>
            </div>
            Please follow the steps below:
            <ul class="p-2 list-disc list-inside">
                <li class="p-1">Sign in to your account.</li>
                <li class="p-1">Go to the Checkout Settings.</li>
                <li class="p-1">Set Redirect and Callback URLs</li>
                <li class="p-1">Copy private token, you will use this private token to connect {{config('coin.name')}} API.</li>
                <li class="p-1">After that there will be 2 steps:</li>
            </ul>
        </p>
        <p>
            <h4 class="my-4 font-semibold">1. Create a form and send POST request as below:</h4>
        </p>
        <p>
                <pre><code class="language-php">@php $code = '
<?php
    // This is an HTML & PHP example

    $paraData = base64_encode(json_encode([
        "receiver" => "YOUR_PARA_ADDRESS",
        "orderToken" => "UNIQUE_ORDER_TOKEN",
        "info" => "PRODUCT_INFO",
        "amount" => 10,
        "customAmount" => 0,
    ]));

    echo "<a href=\'https://paracoin.network/checkout/$paraData\'>Submit Payment</a>";
?>';echo htmlentities(trim($code));@endphp </code></pre>
    
    </p>
    <p>
        <div class="my-4 font-semibold">Properties: </div>
        <ul class="codeExplain">
            <li><span>receiver</span> - Your {{config('coin.name')}} address.</li>
            <li><span>orderToken</span> - The unique identifier for the order</li>
            <li><span>info</span> - Transaction info</li>
            <li><span>amount</span> - Payment amount</li>
            <li><span>customAmount</span> - Set 1 to allow customers to edit and enter a custom amount. Default is 0 and prevents amount editing.</li>
        </ul>
    </p>

    <p>
        <h4 class="my-4 font-semibold">2. Receive callback and process the order:</h4>
    </p>
    <p>
        <pre><code class="language-php">@php $code = '<?php
    // This is a PHP callback example

    $receiver = "YOUR_PARA_ADDRESS";
    $privateToken = "YOUR_PRIVATE_TOKEN";

    $orderToken = $_POST["orderToken"];
    $receiver = $_POST["receiver"];
    $amount = $_POST["amount"];
    $orderHash = $_POST["orderHash"];
    $debugMode = $_POST["debugMode"];

    $hash = md5($orderToken.$receiver.$amount.$privateToken);

    if ( $hash != $orderHash || $debugMode) return 0;

    // You can add more filters and security checks depending on your needs.
    
    // Process the order here.

    return 1;

?>';echo htmlentities(trim($code));@endphp </code></pre>

</p>
<p>
    <div class="my-4 font-semibold">Properties:</div>
    <ul class="codeExplain">
        <li><span>receiver</span> - Your {{config('coin.name')}} address.</li>
        <li><span>privateToken</span> - You can find your private token on the checkout settings.</li>
        <li><span>orderToken</span> - The unique identifier for the order</li>
        <li><span>amount</span> - Payment amount</li>
        <li><span>orderHash</span> - MD5 hash of order token, receiver, amount and private token.</li>
        <li><span>debugMode</span> - If you turn on debug Mode on the checkout settings, debugMode will be true, otherwise false.</li>
    </ul>
</p>

    @push('extra-scripts')
        <!-- Styles -->
        <link href="{{ asset('assets/prism/prism.css?1') }}" rel="stylesheet">
        <!-- Scripts -->
        <script src="{{ asset('assets/prism/prism.js?1')}}"></script>

    @endpush
@stop
