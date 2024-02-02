<?php

namespace App\Queries\QueryFilters;

use App\Models\Tour;
use App\Queries\GiveMeTravels;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class DateFilter extends AbstractFilter
{
    /**
     * @param  GiveMeTravels|Builder<Tour>  $query
     */
    public function perform(GiveMeTravels|Builder $query): void
    {
        if ($this->searchData) {

            $dateFromIsInserted = $this->searchData->dateFrom instanceof Carbon;
            $dateToIsInserted = $this->searchData->dateTo instanceof Carbon;

            $query->when($dateFromIsInserted, function ($query) {
                /**
                 * @phpstan-ignore-next-line
                 */
                $query->where('startingDate', '>=', $this->searchData->dateFrom);
            })
                ->when($dateToIsInserted, function ($query) {
                    /**
                     * @phpstan-ignore-next-line
                     */
                    $query->where('startingDate', '<=', $this->searchData->dateTo);
                });

        }

    }
}
