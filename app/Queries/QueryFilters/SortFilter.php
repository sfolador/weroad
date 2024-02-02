<?php

namespace App\Queries\QueryFilters;

use App\Models\Tour;
use App\Queries\GiveMeTravels;
use Illuminate\Database\Eloquent\Builder;

class SortFilter extends AbstractFilter
{
    /**
     * @param  GiveMeTravels|Builder<Tour>  $query
     */
    public function perform(GiveMeTravels|Builder $query): void
    {
        if ($this->searchData) {

            $query->when($this->searchData->sortDirection, function ($q) {
                /**
                 * @phpstan-ignore-next-line
                 */
                $q->orderBy('price', $this->searchData->sortDirection->value);
            });

        }

    }
}
