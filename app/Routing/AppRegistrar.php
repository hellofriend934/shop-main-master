<?php
declare(strict_types=1);

namespace App\Routing;


use App\Contracts\RouteRegistrar;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;


class AppRegistrar implements RouteRegistrar
{
public function map(Registrar $registrar):void
{
    \Illuminate\Support\Facades\Route::middleware('web')->group(function (){
        Route::get('/',\App\Http\Controllers\HomeController::class)->name('home');
        Route::get('/storage/images/{dir}/{method}/{size}/{file?}',\App\Http\Controllers\ThumbnailController::class)->name('thumbnail');
    });
}
}
