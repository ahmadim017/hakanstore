<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    route::livewire('/login','console.login')
    ->layout('layouts.auth')->name('console.login');

    route::livewire('/logout','console.logout')
    ->layout('layouts.console')->name('console.logout');
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
        
    });
});