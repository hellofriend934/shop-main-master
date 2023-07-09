<?php

namespace App\Providers;

use App\Filters\BrandFilter;
use App\Filters\PriceFilter;
use App\Http\Kernel;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Domain\Catalog\Filters\FilterManager;
use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FilterManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         app(FilterManager::class)->registerFilters([
            new PriceFilter(),
             new BrandFilter()
         ]);
    }
}
