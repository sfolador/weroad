<?php

namespace App\Queries\QueryFilters;

use App\Data\Search\SearchData;
use App\Queries\GiveMeTravels;
use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class DateFilter extends AbstractFilter
{

    public function perform(GiveMeTravels|Builder $query): void
    {
        if ($this->searchData) {

            $dateFromIsInserted = $this->searchData->dateFrom && ($this->searchData->dateFrom instanceof Carbon);
            $dateToIsInserted = $this->searchData->dateTo && ($this->searchData->dateTo instanceof Carbon);

            $query->when($dateFromIsInserted, function ($query) {
                $query->where('startingDate', '>=', $this->searchData->dateFrom);
            })
                ->when($dateToIsInserted, function ($query) {
                    $query->where('startingDate', '<=', $this->searchData->dateTo);
                });

        }

    }
}
