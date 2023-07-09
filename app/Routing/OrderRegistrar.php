<?php
declare(strict_types=1);

namespace App\Routing;


use App\Contracts\RouteRegistrar;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;


class OrderRegistrar implements RouteRegistrar
{
public function map(Registrar $registrar):void
{
    \Illuminate\Support\Facades\Route::middleware('web')->group(function (){
       Route::get('/order', [OrderController::class,'index'])->name('order');
       Route::post('/order/create', [OrderController::class,'handle'])->name('order.handle');
    });
}
}
