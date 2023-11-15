@extends('layouts.defaultView')

@section('content')

    <div class="max-w-sm">
        <div id="payment-status-container" class="alert" style="display:none;"></div>

        <div>
            <label class="text-sm font-medium text-gray-900">
                @lang('text.Current Price'): <span class="text-indigo-600 text-lg">{{number_format($currentPrice, 6)}}</span> {{config('coin.currency')}}
            </label>
        </div>
        <p class="mb-4 text-sm text-gray-500 sm:mt-0">Note: {{config('coin.name')}} @lang('text.amount is estimated amount. Final amount will be calculated during the transaction.')</p>
        <form id="payment-form">

            <div class = "mb-10">
                <label for="amount" class="block text-sm font-medium text-gray-700"></label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    {{Form::text('amount', null, [
                        'class'=>'focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-3 pr-12 sm:text-sm border-gray-300 rounded-md', 
                        'placeholder'=>__('text.Amount'), 
                        'step' => '0.0000001', 
                        'min'=>1, 
                        'max'=>5,
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

            <div class = "mb-10">
                <label for="amount" class="block text-sm font-medium text-gray-700"></label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    {{Form::text('coinAmount', null, [
                        'class'=>'focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-3 pr-12 sm:text-sm border-gray-300 rounded-md', 
                        'placeholder'=>__('text.Estimated Coin Amount'), 
                        'step' => '0.0000001', 
                        'min'=>1, 
                        'max'=>5,
                        'required' => 'required',
                        'id' => 'coinAmount'
                        ] )}}
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    <label for="currency" class="sr-only">{{config('coin.symbol')}}</label>
                    <select id="currency" name="currency" class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                        <option>{{config('coin.symbol')}}</option>
                    </select>
                    </div>
                </div>
            </div>

            <div id="card-container"></div>

            <button id="card-button" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">@lang('text.Buy')</button>
        </form>
    </div>

    @push('head')
        <script>
            $(function () {

                function isNumeric(n) {
                    return !isNaN(parseFloat(n)) && isFinite(n);
                }

                $("#amount").on("input", function() {
                    var amount = $(this).val().trim();
                    if (!isNumeric(amount)) amount = 0;
                    let coinAmount = (amount / {{$currentPrice}}).toFixed(6);
                    $('#coinAmount').val(coinAmount);
                });

                $("#coinAmount").on("input", function() {
                    var coinAmount = $(this).val().trim();
                    if (!isNumeric(coinAmount)) coinAmount = 0;
                    let amount = (coinAmount * {{$currentPrice}}).toFixed(6);
                    $('#amount').val(amount);
                });
            });
        </script>

        <script type="text/javascript" src="https://{{ env('SQUARE_ENVIRONMENT') == 'production' ? '' : 'sandbox.'}}web.squarecdn.com/v1/square.js"></script>
        <script>
            const appId = "{{ env('SQUARE_APP_ID') }}";
            const locationId = "{{ env('SQUARE_LOCATION_ID') }}"; 

            async function initializeCard(payments) {
            const card = await payments.card();
                await card.attach('#card-container'); 
                return card; 
            }

            // Call this function to send a payment token, buyer name, and other details
            // to the project server code so that a payment can be created with 
            // Payments API


            async function createPayment(token) {
                let amount = document.getElementById('amount').value;
                const body = JSON.stringify({
                    locationId,
                    sourceId: token,
                    amount: amount,
                });
                
                const response = await fetch('/square/process', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body,
                });
                if (!response.ok) {
                    const message = `An error has occured: ${response.status}`;
                    throw new Error(message);
                }
                const responseBody = await response.json();
                if (responseBody.error) {
                    if (responseBody.errorMsg[0].hasOwnProperty('detail')) responseBody.errorMsg = responseBody.errorMsg[0].detail;
                    console.log(responseBody.errorMsg);
                    throw new Error(responseBody.errorMsg);
                }
                if (responseBody.error) return true;
                
            }

            // This function tokenizes a payment method. 
            // The ‘error’ thrown from this async function denotes a failed tokenization,
            // which is due to buyer error (such as an expired card). It is up to the
            // developer to handle the error and provide the buyer the chance to fix
            // their mistakes.
            async function tokenize(paymentMethod) {
                const tokenResult = await paymentMethod.tokenize();
                if (tokenResult.status === 'OK') {
                    return tokenResult.token;
                } else {
                    let errorMessage = `Tokenization failed-status: ${tokenResult.status}`;
                    if (tokenResult.errors) {
                    errorMessage += ` and errors: ${JSON.stringify(
                        tokenResult.errors
                    )}`;
                    }
                    throw new Error(errorMessage);
                }
            }

            // Helper method for displaying the Payment Status on the screen.
            // status is either SUCCESS or FAILURE;
            function displayPaymentResults(status, text = "") {
                const statusContainer = document.getElementById('payment-status-container');

                if (status === 'SUCCESS') {
                    statusContainer.classList.remove('alert-danger');
                    statusContainer.classList.add('alert-success');
                    statusContainer.innerText = 'Transaction was successful';
                } else {
                    statusContainer.classList.remove('alert-success');
                    statusContainer.classList.add('alert-danger');
                    statusContainer.innerText = text;
                }

                statusContainer.style.display = 'block';
            }  

            document.addEventListener('DOMContentLoaded', async function () {
                if (!window.Square) {
                    throw new Error('Square.js failed to load properly');
                }

                const payments = window.Square.payments(appId, locationId);
                let card;
                try {
                    card = await initializeCard(payments);
                } catch (e) {
                    console.error('Initializing Card failed', e);
                    return;
                }

                // Checkpoint 2.
                async function handlePaymentMethodSubmission(event, paymentMethod) {
                    event.preventDefault();
                    const amountContainer = document.getElementById('amount');
                    if (amountContainer.value < {{config('coin.minAmount')}}) {
                        displayPaymentResults('FAILURE', "Minimum amount can be {{config('coin.minAmount')}} {{config('coin.currency')}}.");
                        return;
                    }
                    if (amountContainer.value > {{config('coin.maxAmount')}}) {
                        displayPaymentResults('FAILURE', "Maximum amount can be {{config('coin.maxAmount')}} {{config('coin.currency')}}.");
                        return;
                    }

                    try {
                        // disable the submit button as we await tokenization and make a
                        // payment request.
                        cardButton.disabled = true;
                        const token = await tokenize(paymentMethod);
                        const paymentResults = await createPayment(token);
                        displayPaymentResults('SUCCESS');

                        console.debug('Payment Success', paymentResults);
                    } catch (e) {
                        cardButton.disabled = false;
                        displayPaymentResults('FAILURE', 'Transaction failed! (' + e.message + ')');
                        console.error(e.message);
                    }
                }

                const cardButton = document.getElementById(
                    'card-button'
                );
                cardButton.addEventListener('click', async function (event) {
                    await handlePaymentMethodSubmission(event, card);
                });
            });
        </script>
    @endpush
@stop
