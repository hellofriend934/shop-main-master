<?php
declare(strict_types=1);


namespace App\Filters;

use Domain\Catalog\Model\Brand;
use Domain\Catalog\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class BrandFilter extends AbstractFilter
{

    public function title(): string
    {
        return 'бренды';
    }

    public function key(): string
    {
        return 'brands';
    }

    public function apply(Builder $builder): Builder
    {
       return $builder->when($this->requestValue(), function (Builder $q){
            $q->whereIn('brand_id', $this->requestValue());
        });
    }

    public function values(): array
    {
        return
            Brand::query()->select('title','id')->has('products')->get()->pluck('title','id')->toArray();

    }

    public function view(): string
    {
        return 'catalog.Filters.brands';
    }

    public function __toString()
    {
       return view($this->view(),['filter'=>$this])->render();
    }
}
