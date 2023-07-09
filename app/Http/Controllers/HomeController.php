<?php

namespace App\Http\Controllers;



use Domain\Catalog\BrandViewModel;
use Domain\Catalog\ViewModels\CategoryViewModel;
use Domain\Product\Models\Product;
use Supports\Traits\Makeble;

class HomeController extends Controller
{
    use Makeble;
    public function __invoke()
    {
        $categories = CategoryViewModel::homePage();
        $products  = Product::query()->homePage()->get();
        $brands  = BrandViewModel::homePage();
//        flash()->info('test');
        return view('index', compact('categories','products','brands'));
    }
}
