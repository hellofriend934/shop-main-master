<?php

namespace Domain\Cart\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    use MassPrunable;
    protected $guarded = false;

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subWeek());
    }
}
