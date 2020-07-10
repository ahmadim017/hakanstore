<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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

Route::livewire('/', 'frontend.home.index')
->layout('layouts.frontend')->name('root');

View::composer('*', function($view) {
    $global_categories = \App\Category::latest()->take(6)->get();
    $view->with('global_categories', $global_categories);
});

//api raja ongkir
Route::get('/provinces', 'ApiController@getProvinces');
Route::get('/cities', 'ApiController@getCities');
Route::get('/districts', 'ApiController@getDistricts');
Route::post('/shipping', 'ApiController@getShipping');
Route::get('/check_voucher', 'ApiController@check_voucher');
Route::post('/checkout', 'ApiController@checkout');
Route::post('/waybill', 'ApiController@getWaybill');

Route::livewire('/payment/{invoice_id}', 'frontend.payment.index')
->layout('layouts.frontend')->name('frontend.payment.index')->middleware('auth:customer');

Route::group(['middleware' => 'guest'], function () {

    Route::livewire('/customer/register', 'customer.auth.register')
    ->layout('layouts.frontend')->name('customer.auth.register');

    Route::livewire('/customer/login', 'customer.auth.login')
    ->layout('layouts.frontend')->name('customer.auth.login');

    Route::livewire('/customer/logout', 'customer.auth.logout')
    ->layout('layouts.frontend')->name('customer.auth.logout');

    Route::livewire('/cart', 'frontend.cart.index')
    ->layout('layouts.frontend')->name('frontend.cart.index');

    route::livewire('/login','console.login')
    ->layout('layouts.auth')->name('console.login');

    route::livewire('/logout','console.logout')
    ->layout('layouts.console')->name('console.logout');

});

Route::prefix('customer')->group(function () {

    Route::group(['middleware' => 'auth:customer'], function(){

        //dashboard
        Route::livewire('/dashboard', 'customer.dashboard.index')
        ->layout('layouts.frontend')->name('customer.dashboard.index');
        //order
        Route::livewire('/orders', 'customer.orders.index')
        ->layout('layouts.frontend')->name('customer.orders.index');

        Route::livewire('/orders/{id}', 'customer.orders.show')
        ->layout('layouts.frontend')->name('customer.orders.show');
        //profile

        Route::livewire('/profile', 'customer.profile.index')
        ->layout('layouts.frontend')->name('customer.profile.index');

    });
});

route::prefix('console')->group(function(){
    Route::group(['middleware' => 'auth'], function () {

        //console dashboard
        route::livewire('/dashboard','console.dashboard.index')
        ->layout('layouts.console')->name('console.dashboard.index');

        //category
        route::livewire('/categories','console.categories.index')
        ->layout('layouts.console')->name('console.categories.index');

        route::livewire('/categories/create','console.categories.create')
        ->layout('layouts.console')->name('console.categories.create');

        route::livewire('/categories/edit/{id}','console.categories.edit')
        ->layout('layouts.console')->name('console.categories.edit');

        //product
        route::livewire('/products','console.products.index')
        ->layout('layouts.console')->name('console.products.index');

        route::livewire('/products/create','console.products.create')
        ->layout('layouts.console')->name('console.products.create');

        route::livewire('/products/edit/{id}','console.products.edit')
        ->layout('layouts.console')->name('console.products.edit');

        //voucher
        route::livewire('/voucher','console.voucher.index')
        ->layout('layouts.console')->name('console.voucher.index');

        route::livewire('/voucher/create','console.voucher.create')
        ->layout('layouts.console')->name('console.voucher.create');

        route::livewire('/voucher/edit/{id}','console.voucher.edit')
        ->layout('layouts.console')->name('console.voucher.edit');

        //order
        route::livewire('/orders','console.orders.index')
        ->layout('layouts.console')->name('console.orders.index');

        route::livewire('/orders/{id}','console.orders.show')
        ->layout('layouts.console')->name('console.orders.show');

        route::livewire('/orders/status/{id}','console.orders.status')
        ->layout('layouts.console')->name('console.orders.status');

        route::livewire('/orders/receipt/{id}','console.orders.receipt')
        ->layout('layouts.console')->name('console.orders.receipt');

        //payment
        route::livewire('/payment','console.payment.index')
        ->layout('layouts.console')->name('console.payment.index');

        route::livewire('/payment/{id}','console.payment.show')
        ->layout('layouts.console')->name('console.payment.show');

        //sliders
        route::livewire('/sliders','console.sliders.index')
        ->layout('layouts.console')->name('console.sliders.index');

        //user
        route::livewire('/users','console.users.index')
        ->layout('layouts.console')->name('console.users.index');

        route::livewire('/users/create','console.users.create')
        ->layout('layouts.console')->name('console.users.create');

        route::livewire('/users/edit/{id}','console.users.edit')
        ->layout('layouts.console')->name('console.users.edit');
        
    });

     

     //customer register

});