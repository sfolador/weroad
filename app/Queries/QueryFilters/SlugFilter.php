<?php

namespace App\Queries\QueryFilters;

use App\Queries\GiveMeTravels;
use Illuminate\Database\Eloquent\Builder;

class SlugFilter extends AbstractFilter
{
    public function perform(GiveMeTravels|Builder $query): void
    {
        if ($this->searchData) {
            $query->whereHas('travel', function ($q) {
                $q->where('slug', $this->searchData->slug);
            });
        }

    }
}
