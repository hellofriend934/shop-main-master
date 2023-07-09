<?php

namespace Domain\Product\Models;


use App\Models\OptionValue;
use App\Models\Property;
use App\Traits\Models\HasThumbnail;
use Domain\Catalog\Model\Category;
use Domain\Product\QueryBuilders\ProductQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Routing\Pipeline;
use Supports\Casts\PriceCast;


class Product extends Model
{
    use HasFactory;
    use HasThumbnail;

    protected $guarded = false;

    protected $casts =[
      'price'=>PriceCast::class,
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Product $product){
            $product->slug = $product->slug ?? str($product->title)->slug();
        });
        static::created(function (Product $product){
            $properties = $product->properties()->get();
            $properties->mapWithKeys(fn($property)=>[$property->title => $property->pivot->value]);
        });
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'id', 'brand_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany( Category::class, 'category_product', 'category_id', 'id');
    }

    public function scopeHomePage(Builder $query){
        $query->where('on_home_page',true)->orderBy('sorting')->limit(6);
    }




    public function properties()
    {
        return $this->belongsToMany(Property::class)->withPivot('value');
    }

    public function optionValues()
    {
        return $this->belongsToMany(OptionValue::class);
    }

    protected function thumbnailDir(): string
    {
        return 'products';
    }

    //SCOPES FOR FILTERS

    public function scopeFiltered(Builder $query)
    {
        return app(Pipeline::class)->send($query)->through(filters())->thenReturn();
    }

    public function scopeSorted(Builder $query)
    {
        $query->when(request('sort'), function (Builder $q){
            $column = request()->str('sort');
            if ($column->contains(['price','title'])){
                $direction = $column->contains('-')? 'DESC' : 'ASC';
                $q->orderBy((string)$column->remove('-'),$direction);
            }
        });
    }


    public function homePage(){
        return  $this->where('on_home_page',true)->orderBy('sorting')->limit(6);
    }


    public function search()
    {

    }
}
