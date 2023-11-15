<?php
use Illuminate\Support\Facades\Route;

//My Admin

Route::get('/my-admin', 'Myadmin\MainController@index');
Route::post('/my-admin/login', 'Myadmin\MainController@login');



Route::get('/my-admin/blog/list', 'Myadmin\BlogController@list');
Route::post('/my-admin/blog/add', 'Myadmin\BlogController@add');
Route::post('/my-admin/blog/edit/{id}', 'Myadmin\BlogController@edit');
Route::post('/my-admin/blog/delete', 'Myadmin\BlogController@delete');
Route::post('/my-admin/blog/upload', 'Myadmin\BlogController@upload');

Route::get('/my-admin/menu/items', 'Myadmin\MenuController@items');
Route::post('/my-admin/menu/add', 'Myadmin\MenuController@add');
Route::post('/my-admin/menu/edit/{id}', 'Myadmin\MenuController@edit');
Route::post('/my-admin/menu/delete', 'Myadmin\MenuController@delete');
Route::post('/my-admin/menu/upload', 'Myadmin\MenuController@upload');

Route::get('/my-admin/category/items', 'Myadmin\CategoryController@items');
Route::post('/my-admin/category/add', 'Myadmin\CategoryController@add');
Route::post('/my-admin/category/edit/{id}', 'Myadmin\CategoryController@edit');
Route::post('/my-admin/category/delete', 'Myadmin\CategoryController@delete');
Route::post('/my-admin/category/upload', 'Myadmin\CategoryController@upload');


Route::get('/my-admin/product/list', 'Myadmin\ProductController@list');
Route::post('/my-admin/product/add', 'Myadmin\ProductController@add');
Route::post('/my-admin/product/edit/{id}', 'Myadmin\ProductController@edit');
Route::post('/my-admin/product/delete', 'Myadmin\ProductController@delete');
Route::post('/my-admin/product/upload', 'Myadmin\ProductController@upload');

Route::get('/my-admin/text/items', 'Myadmin\TextController@items');
Route::post('/my-admin/text/add', 'Myadmin\TextController@add');
Route::post('/my-admin/text/edit/{id}', 'Myadmin\TextController@edit');
Route::post('/my-admin/text/delete', 'Myadmin\TextController@delete');
Route::post('/my-admin/text/upload', 'Myadmin\TextController@upload');


Route::get('/my-admin/aboutus/items', 'Myadmin\AboutusController@items');
Route::post('/my-admin/aboutus/edit', 'Myadmin\AboutusController@edit');

Route::get('/my-admin/faq/items', 'Myadmin\FaqController@items');
Route::post('/my-admin/faq/add', 'Myadmin\FaqController@add');
Route::post('/my-admin/faq/edit/{id}', 'Myadmin\FaqController@edit');
Route::post('/my-admin/faq/delete', 'Myadmin\FaqController@delete');
Route::post('/my-admin/faq/upload', 'Myadmin\FaqController@upload');


Route::get('/my-admin/social/items', 'Myadmin\SocialController@items');
Route::post('/my-admin/social/add', 'Myadmin\SocialController@add');
Route::post('/my-admin/social/edit/{id}', 'Myadmin\SocialController@edit');
Route::post('/my-admin/social/delete', 'Myadmin\SocialController@delete');
Route::post('/my-admin/social/upload', 'Myadmin\SocialController@upload');

Route::get('/my-admin/photo/list', 'Myadmin\PhotoController@list');
Route::post('/my-admin/photo/add', 'Myadmin\PhotoController@add');
Route::post('/my-admin/photo/edit/{id}', 'Myadmin\PhotoController@edit');
Route::post('/my-admin/photo/delete', 'Myadmin\PhotoController@delete');
Route::post('/my-admin/photo/upload', 'Myadmin\PhotoController@upload');

Route::get('/my-admin/coinAddress/items', 'Myadmin\CoinAddressController@items');
Route::post('/my-admin/coinAddress/add', 'Myadmin\CoinAddressController@add');
Route::post('/my-admin/coinAddress/edit/{id}', 'Myadmin\CoinAddressController@edit');
Route::post('/my-admin/coinAddress/delete', 'Myadmin\CoinAddressController@delete');
Route::post('/my-admin/coinAddress/balance/{id}', 'Myadmin\CoinAddressController@balance');
Route::get('/my-admin/coinAddress/price', 'Myadmin\CoinAddressController@price');
