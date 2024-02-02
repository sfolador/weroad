<?php

namespace App\Queries\QueryFilters;

use App\Queries\GiveMeTravels;
use Illuminate\Database\Eloquent\Builder;

class PriceFilter extends AbstractFilter
{


    public function perform(GiveMeTravels|Builder $query): void
    {
        if ($this->searchData) {
            $query->when($this->searchData->priceFrom, function ($q) {

                $q->where('price', '>=', $this->searchData->priceFrom);
            })
                ->when($this->searchData->priceTo, function ($q) {
                    $q->where('price', '<=', $this->searchData->priceTo);
                });
        }

    }
}
