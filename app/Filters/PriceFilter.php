<?php
declare(strict_types=1);

namespace App\Filters;

use Domain\Catalog\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class PriceFilter extends AbstractFilter
{


    public function title(): string
    {
        return 'Цена';
    }

    public function key(): string
    {
        return 'price';
    }
    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $q){
            $q->whereBetween('price',[
                request('filters.price.from',0) * 100,
                request('filters.price.to',100000) * 100
            ]);
        });
    }

    public function values(): array
    {
        return  [
            'from'=>0,
            'to'=>100000
        ];
    }

    public function view(): string
    {
        return  'catalog.filters.price';
    }

    public function __toString():string
    {
        return view($this->view(),['filter'=>$this])->render();
    }
}
