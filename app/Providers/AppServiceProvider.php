<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer('*', function ($view) {
        //     // Giả sử bạn có một service hoặc model để lấy dữ liệu cart
        //     $cart = \App\Services\CartService::getCart();
        //     $view->with('cart', $cart);
        // });
    }
}
