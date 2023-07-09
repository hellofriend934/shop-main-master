<?php

namespace App\Http\Controllers;

use Domain\Product\Models\Product;
use Domain\Cart\Models\CartItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('cart.index', ['items'=>cart()->items()]);
    }

    public function add(Product $product):RedirectResponse
    {
        cart()->add(
            $product,
            \request('quantity', 1),
            \request('options',[])
        );
//        flash()->info('добавленно в корзину');
        return redirect()->intended(route('cart'));
    }

    public function quantity(CartItem $item):RedirectResponse
    {
        cart()->quantity($item, \request('quantity',1));
//        flash()->info('кол-во товара изменено');
        return redirect()->intended(route('cart'));
    }

    public function delete(CartItem $item):RedirectResponse
    {
        cart()->delete($item);
//        flash()->info('товар удален');
        return redirect()->intended(route('cart'));
    }

    public function truncate():RedirectResponse
    {
        cart()->truncate();
//        flash()->info('корзина очищена');
        return redirect()->intended(route('cart'));
    }


}
