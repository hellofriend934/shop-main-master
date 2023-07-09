<?php
declare(strict_types=1);

namespace Domain\Catalog\ViewModels;

use Domain\Catalog\Model\Category;
use Illuminate\Support\Facades\Cache;

class CategoryViewModel
{
  public static function homePage()
  {
      return Cache::rememberForever('category_home_page', function (){
          return Category::query()->homePage()->get();
      });

  }
}
