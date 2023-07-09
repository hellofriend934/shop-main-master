<?php
declare(strict_types=1);

namespace App\Traits;

use App\Models\brand;
use App\Models\Category;
use Domain\Product\Models\Product;

trait Costyl
{
    public $categories;
    public $brand;
    public $products;
    public function __construct()
    {
        $categories = Category::query()->get();
        $products  = Product::query()->get();
        $brands  = brand::query()->get();
    }

}
