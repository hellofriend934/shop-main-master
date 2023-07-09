<?php

namespace App\Http\Controllers;

use Domain\Product\Models\Product;

class ProductController extends Controller
{

    public function __invoke(Product $product)
    {
        $product->load(['optionValues.option']);
        $options = $product->optionValues->mapToGroups(function ($item){
            return [$item->option->title => $item];
        });


        $watchedProducts = [];
        if (session('watched')){
            $watched= session()->get('watched');
            if(is_array($watched)){
                $watchedProducts= Product::query()->whereIn('id', $watched)->get();
            }
            $watchedProducts = Product::query()->where('id', $watched)->get();
        }
//dd($watchedProducts);
        session()->put('watched' ,$product->id);

        return isset($watchedProducts) ? view('product.shared.show',['product'=>$product,'options'=>$options]) : view('product.shared.show',['product'=>$product,'options'=>$options, 'watchedProducts'=>$watchedProducts]);

    }
}
