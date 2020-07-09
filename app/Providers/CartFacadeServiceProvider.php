<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Cart;
use Illuminate\Support\Facades\App;


class CartFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('cart', function(){
            return new Cart;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
