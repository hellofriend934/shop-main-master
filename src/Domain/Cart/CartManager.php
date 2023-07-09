<?php
declare(strict_types=1);

namespace Domain\Cart;

use Domain\Cart\Contracts\CartIdentityStorageContract;
use Domain\Cart\Models\Cart;
use Domain\Cart\Models\CartItem;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Supports\ValueObjects\Price;

class CartManager
{
    protected static $identityStorage;
    public function __construct(
        protected CartIdentityStorageContract $identity,
    )
    {
        self::$identityStorage = $this->identity;
    }
    private static function storageData(string $id = ' ')
    {

        $data = ['storage_id'=>$id];

        if (auth()->check()){
            $data['user_id'] = auth()->id();
        }
        return $data;
    }

    public function updateStorageId($old, $new): void
    {
        Cart::query()->where('storage_id', $old)->update(['storage_id'=>self::storageData($new)]);
     }

    public static function stringedOptionValues(array $optionValues)
    {
        sort($optionValues);
        return implode(';', $optionValues);
    }


    public static function add(Product $product, int $quantity = 1, array $optionValues = []) //создаем корзину
    {
        $cart = Cart::query()->updateOrCreate(['storage_id'=>self::$identityStorage->get()], self::storageData(self::$identityStorage->get()));
        $cartItem = $cart->cartItems()->updateOrCreate(['product_id'=>$product->getKey(), 'string_option_values'=>self::stringedOptionValues($optionValues)], ['price'=>$product->price, 'quantity'=> DB::raw("quantity + $quantity"), 'string_option_values'=>self::stringedOptionValues($optionValues)]);

        $cartItem->optionValues()->sync($optionValues);

        self::forgotCache();

        return $cart;
    }



    public static function quantity(CartItem $item, int $quantity = 1):void
    {
        $item->update(['quantity'=>$quantity]);
        self::forgotCache();
    }


    public  static function delete(CartItem $item):void
    {
        $item->delete();
    }


    public function truncate():void
    {
        $cart = $this->get()?->delete();

        self::forgotCache();
    }


    public function get() // получаем нашу корзину со всеми значениям(нужно например для транкейта)  //TODO научиться работать с кешированием
    {
        return Cache::remember($this->cacheKey(), now()->addHour(), function (){
            return Cart::query()->with('cartItems')->where('storage_id',self::$identityStorage->get())->when(auth()->check(), fn(Builder $query)=>$query->orWhere('user_id', auth()->id()))->first() ?? false;
        });
    }


    public function cartItems() //получить все значения корзины в виде коллекции нужно для count
    {
        return $this->get()?->cartItems ?? collect([]);
    }

    public function items()
    {
        if (!$this->get()){
            return collect([]);
        }
        return CartItem::query()->with(['product', 'optionValues.option'])->whereBelongsTo($this->get())->get();
    }

    public function count() //получить все значения корзины
    {
        return $this->cartItems()->sum(function ($item){
            return $item->quantity;
        });
    }

    public function total(): \Supports\ValueObjects\Price
    {
        return Price::make($this->cartItems()->sum(function ($item){
            return $item->amount->raw();
        }));
    }

    public static function cacheKey():string
    {
        return str('cart_' . self::$identityStorage->get())->slug('_')->value();
    }

    public static function forgotCache():void
    {
        Cache::forget(self::cacheKey());
    }


}
