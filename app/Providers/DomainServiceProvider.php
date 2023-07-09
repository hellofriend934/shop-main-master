<?php

namespace App\Providers;

use Domain\Auth\Providers\AuthServiceProvider;
use Domain\Auth\Providers\dcAuthServiceProvider;
use Domain\Cart\Providers\CartServiceProvider;
use Domain\Order\Providers\OrderServiceProvider;
use Domain\Order\Providers\PaymentServiceProvider;
use Domain\Product\Providers\ProductServiceProvider;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(ProductServiceProvider::class);
        $this->app->register(CartServiceProvider::class);
        $this->app->register(OrderServiceProvider::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
