<?php
declare(strict_types=1);

namespace Supports\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Supports\ValueObjects\Price;

class PriceCast implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        return Price::make($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        if (!$value instanceof Price)
        {
            $value = Price::make($value);
        }
        return $value->raw();
    }
}
