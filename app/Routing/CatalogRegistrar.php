<?php
declare(strict_types=1);

namespace App\Routing;


use App\Contracts\RouteRegistrar;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CatalogViewMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;


class CatalogRegistrar implements RouteRegistrar
{
public function map(Registrar $registrar):void
{
    \Illuminate\Support\Facades\Route::middleware('web')->group(function (){
       Route::get('/catalog/{category:slug?}', CatalogController::class)->name('catalog')->middleware(CatalogViewMiddleware::class);;
//        Route::get('/product/{$product}', ProductController::class)->name('product');
    });
}
}
