<?php
declare(strict_types=1);

namespace App\Routing;


use App\Contracts\RouteRegistrar;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CatalogViewMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;
use function Clue\StreamFilter\fun;


class CartRegistrar implements RouteRegistrar
{
public function map(Registrar $registrar):void
{
    \Illuminate\Support\Facades\Route::middleware('web')->group(function (){
      Route::controller(CartController::class)->prefix('cart')->group(function (){
         Route::get('/','index')->name('cart');
         Route::post('/{product}/add','add')->name('cart.add');
         Route::get('/{item}/quantity','quantity')->name('cart.quantity');
         Route::delete('/{items}/delete','delete')->name('cart.delete');
         Route::delete('/truncate','truncate')->name('cart.truncate');
      });
    });
}
}
