<?php

namespace App\Queries\QueryFilters;

use App\Data\Search\SearchData;
use App\Queries\GiveMeTravels;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class SortFilter extends AbstractFilter
{

    public function perform(GiveMeTravels|Builder $query): void
    {
        if ($this->searchData) {

           $query->when($this->searchData->sortDirection, function ( $q) {
                $q->orderBy('price', $this->searchData->sortDirection->value);
            });

        }

    }
}
