<?php

namespace Domain\Cart\Models;


use App\Models\OptionValue;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Supports\ValueObjects\Price;
use Supports\Casts\PriceCast;

class CartItem extends Model
{
    use HasFactory;
    protected $guarded = false;

    protected $casts = [
      'price'=>PriceCast::class
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function optionValues()
    {
        return $this->belongsToMany(OptionValue::class);
    }

    public function amount():Attribute
    {
        return Attribute::make(
            get: fn() => Price::make($this->price->raw() * $this->quantity)
        );
    }



}
