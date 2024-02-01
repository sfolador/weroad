<?php

namespace App\Queries\QueryFilters;

use App\Queries\GiveMeTravels;
use Closure;

class DateFilter
{
    public function __construct()
    {
    }

    public function handle(GiveMeTravels $query, Closure $next): mixed
    {
        $query->when($query->searchData->dateFrom, function () {

        })
            ->when($query->searchData->dateTo, function () {

            });

        return $next($query);
    }
}
