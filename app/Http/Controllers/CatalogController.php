<?php

namespace App\Http\Controllers;


use Domain\Catalog\Model\Brand;
use Domain\Catalog\Model\Category;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;


class CatalogController extends Controller
{
    public function __invoke(?Category $category)
    {
        {

            $categories = Category::query()->select('title', 'id', 'slug')->has('products')->get();

            $products = Product::query()->select('title', 'id', 'slug', 'thumbnail', 'price')
                ->when(\request('s'), function (Builder $query) {
                    $query->where('title', 'LIKE', \request('s'));
                })
                ->when($category->exists, function (Builder $query) use ($category) {
                    $query->whereRelation('categories', 'categories.id', '=', $category->id);
                })->filtered()->sorted()->paginate(6);


            $brands = Brand::all();

            return view('catalog.catalog', [
                'products' => $products,
                'categories' => $categories,
                'category' => $category,
                'brands'=>$brands,
            ]);
        }
    }
}
