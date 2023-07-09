<?php

namespace Domain\Catalog\Model;

use App\Traits\Models\HasThumbnail;
use Database\Factories\CategoryFactory;
use Domain\Catalog\QueryBuilders\CategoryQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasThumbnail;
    use HasFactory;
    protected $guarded = false;

public static function boot()
{
    parent::boot();
    static::creating(function (Category $category){
        $category->slug = $category->slug ?? str($category->title)->slug();
    });
}
    public function products()
    {
        return $this->belongsToMany(Category::class,'category_product');

    }

 protected static function newFactory()
 {
     return CategoryFactory::class;
 }


public function newEloquentBuilder($query):CategoryQueryBuilder
{
    return new CategoryQueryBuilder($query);
}

    protected function thumbnailDir(): string
    {
       return 'category';
    }



    public function scopeFiltered(Builder $builder)
    {

    }

    public function scopeSorted(Builder $builder)
    {

    }
}

