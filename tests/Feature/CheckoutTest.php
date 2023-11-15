<?php

namespace Tests\Feature;

use App\Helpers\RequestHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCheckout()
    {

        //$response = $this->call('POST', 'questions', array('_token' => csrf_token(),
        $checkoutSetting = [
            'callbackUrl' => 'http://livescore-local.com/api/para/callback',
            'privateToken' => 'eWjZ5HODJt',
            'debugMode' => 0,
        ];

        $orderToken = '133983857';
        $receiver = 't5t5tbzz4y5z4uiw52zk';
        $amount = '10.000000';
        
        // Send request to the callback URL.
        $data =  [
            'orderToken' => $orderToken, 
            'receiver' => $receiver,
            'amount' => $amount,
            'orderHash' => md5($orderToken.$receiver.$amount.$checkoutSetting['privateToken']),
            'debugMode' => $checkoutSetting['debugMode']
        ];
        $response = RequestHelper::post($checkoutSetting['callbackUrl'], $data);
        
        $this->assertEquals(200, $response['statusCode']);
        $this->assertEquals(1, $response['content']);
        $this->assertEmpty($response['error']);
    }
}
