<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/home', function () {
    return view('pages.home');
});

Route::get('/is_delivered/{id}', [
    'uses' => 'carcontroller@isdelivered',
    'as'=> 'delivery'
]);

Route::get('/get_take_permission/{id}',[
    'uses' => 'Profilecontroller@get_take_permission',
    'as' => 'permission_toggle'
]);

Route::get('/rent', [
    'uses' => 'carcontroller@getCart',
    'as'=> 'product.shoppingCart'
]);

Route::get('/rent/{id}', [
    'uses' => 'carcontroller@getAddToCard',
    'as'=> 'buuz'
]);

Route::get('/reduce/{id}',[
    'uses' => 'carcontroller@getReduceByOne',
    'as' => 'reducebyone'
]);

Route::get('/remove/{id}',[
    'uses' => 'carcontroller@getRemoveItem',
    'as' => 'removeitem'
]);

Route::get('/ban/{id}',[
    'uses' => 'Profilecontroller@banuser',
    'as' => 'banuser'
]);

Route::post('/messages/{id}','Profilecontroller@retrievemessage');
Route::get('/messages/{id}',[
    'uses' => 'Profilecontroller@retrievemessage',
    'as' => 'getmessage'
]);

Route::get('/messages_show',[
    'uses' => 'Profilecontroller@showmessage',
    'as' => 'showmessage'
]);



Route::get('/checkout',[
    'uses' => 'carcontroller@getCheckout',   //hudaldan awalt hiih heseg
    'as' => 'checkout',
    'middleware' => 'auth'
]);

Route::post('/checkout',[
    'uses' => 'carcontroller@postCheckout',   //hudaldan awalt hiih heseg
    'as' => 'checkout',
    'middleware' => 'auth'
]);


Route::get('/posts_report/{id}/', [
    'uses' => 'maincontroller@submitreport',
    'as'=> 'report'
]);

Route::post('/car_posts_submitrate/{id}','carcontroller@submitrate');//from::open-g ashiglahad shaardagdsan submit rate function-g duudah ued
Route::get('/car_posts_submitrate/{id}', [ ////from::open-g ashiglahad shaardagdsan submit rate function-g duudah ued
    'uses' => 'carcontroller@submitrate'
]);


Route::get('/profile', function () {
    return view('pages.profile');
});

Route::get('/turshilt1', function () {
    return view('pages.turshilt');
});


Route::get('/', function () {
    return view('pages.home');
});


//Route::resource('posts','maincontroller');
//Route::resource('car_posts'.'carcontroller');

Route::resources([
    'posts' => maincontroller::class,
    'car_posts' => carcontroller::class,
    'profile'=>Profilecontroller::class
]);

Auth::routes(['verify'=>true]);

Route::get('/dashboard', 'DashboardController@index');

