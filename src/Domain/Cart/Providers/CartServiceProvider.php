<?php
declare(strict_types=1);

namespace Domain\Cart\Providers;

//use App\Providers\DomainServiceProvider;
use Domain\Cart\CartManager;
use Domain\Cart\Models\Cart;
use Domain\Cart\StorageIdentities\SessionIdentityStorage;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
public function boot()
{
$this->app->singleton(CartManager::class, function (){
   return new CartManager(new SessionIdentityStorage());
});
}

public function register():void
{
    $this->app->register(ActionsServiceProvider::class);
}
}
