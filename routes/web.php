<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('setlang/{locale}', function ($lang) {
    if (! in_array($lang, ['en', 'az', 'ru', 'tr'])) {
        abort(400);
    }
    $settings = SETTINGS;
    $settings['language'] = $lang;
    setcookie('settings', serialize($settings), time() + 30 * 24 * 3600, '/');
    return redirect()->back();
});

Route::get('/404', 'MainController@notFound');
Route::get('/development', 'MainController@development');
Route::get('/exchange', 'MainController@development');

Route::get('/', 'CoinController@index');
Route::get('/nft', 'MainController@development');
// Route::get('/nft', 'NftController@index');
Route::get('/nft/view', 'NftController@view');
Route::get('/about', 'MainController@about');
Route::get('/team', 'MainController@team');
Route::get('/faq', 'MainController@faq');
Route::get('/blog', 'BlogController@index');
Route::get('/blog/view', 'BlogController@view');

//auth
Route::get('/auth', 'AuthController@index');//vue
Route::post('/auth/login', 'AuthController@login');
Route::post('/auth/registration', 'AuthController@registration');
Route::get('/auth/logout', 'AuthController@logout');

// Coin
Route::get('/create-address', 'CoinController@create_address');
Route::get('/receive', 'CoinController@receive');
Route::get('/stats', 'CoinController@stats');
Route::get('/white-paper', 'CoinController@white_paper');
Route::get('/roadmap', 'CoinController@roadmap');
Route::get('/roadmap-old', 'CoinController@roadmapOld');
Route::get('/contact', 'ContactController@index');
Route::post('/contact', 'ContactController@submit');
Route::get('/logout', 'CoinController@logout');

Route::get('/user-transactions', 'CoinController@user_transactions');
Route::get('/public-transactions', 'CoinController@public_transactions');

Route::get('/send', 'CoinController@send');
Route::post('/send', 'CoinController@send_submit');

Route::get('/login', 'CoinController@login');
Route::post('/login', 'CoinController@loginSubmit');

Route::get('/profile', 'CoinController@profile');
Route::post('/profile', 'CoinController@profile_submit');

Route::get('/checkout-settings', 'CoinController@checkoutSettings');
Route::post('/checkout-settings', 'CoinController@checkoutSettingsSubmit');

Route::get('api', 'ApiController@index');

// Checkout
//This is for incoming request route from merchants.
Route::get('/checkout/{paraData}', 'CheckoutController@index');

Route::get('/checkout', 'CheckoutController@view');
Route::post('/checkout/pay', 'CheckoutController@pay');
Route::post('/checkout/login', 'CheckoutController@loginSubmit');
Route::post('/checkout/create-address', 'CheckoutController@createAddress');

Route::get('/checkout/test', 'CheckoutController@testPayment');
Route::get('/buy', 'PaymentController@squarePay');
Route::post('/square/process', 'PaymentController@squareProcess');
