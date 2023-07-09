<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      $kernel = app(Kernel::class);
      $kernel->whenRequestLifecycleIsLongerThan(CarbonInterval::second(4), function (){
          logger()->channel('telegram')->debug('lifecycle longer than 4 second');
      });
    }
}
