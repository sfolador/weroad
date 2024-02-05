<?php

namespace App\Queries\QueryFilters;

use App\Models\Tour;
use App\Queries\GiveMeTravels;
use Illuminate\Database\Eloquent\Builder;
use Spatie\LaravelData\Optional;

class VisibilityFilter extends AbstractFilter
{
    /**
     * @param  GiveMeTravels|Builder<Tour>  $query
     */
    public function perform(GiveMeTravels|Builder $query): void
    {
        if ($this->searchData) {
            $query->whereHas('travel', function ($q) {
                /**
                 * @phpstan-ignore-next-line
                 */
                $q->where('public', true);
            });
        }

    }
}
