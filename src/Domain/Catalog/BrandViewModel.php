<?php
declare(strict_types=1);

namespace Domain\Catalog;

use Domain\Catalog\Model\Brand;
use Illuminate\Support\Facades\Cache;

class BrandViewModel
{
  public static function homePage()
  {
       return Cache::rememberForever('brand_home_page', function (){
         return brand::query()->homePage()->get();
      });

  }
}
