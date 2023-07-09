<?php

namespace Domain\Catalog\Model;

use App\Traits\Models\HasThumbnail;
use Domain\Catalog\QueryBuilders\BrandQueryBuilder;
use Domain\Product\QueryBuilders\ProductQueryBuilder;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Brand extends Model
{
    use HasFactory;
    use HasThumbnail;

    protected $guarded = false;

    public static function boot()
    {
        parent::boot();
        static::creating(function (Brand $brand){
            $brand->slug = $brand->slug ?? str($brand->title)->slug();
        });
    }

    public function newEloquentBuilder($query)
    {
        return new BrandQueryBuilder($query);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected function thumbnailDir(): string
    {
        return 'brands';
    }

}
