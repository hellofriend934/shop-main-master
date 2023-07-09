<?php
declare(strict_types=1);

namespace App\Routing;


use App\Contracts\RouteRegistrar;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;


class ProductRegistrar implements RouteRegistrar
{
public function map(Registrar $registrar):void
{
    \Illuminate\Support\Facades\Route::middleware('web')->group(function (){

            Route::get('/product/{product:slug}', ProductController::class)->name('product');
    });
}
}