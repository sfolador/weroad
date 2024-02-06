<?php

namespace App\Actions\Search;

use App\Data\Search\SearchData;
use App\Queries\GiveMeTravels;
use App\Queries\QueryFilters\DateFilter;
use App\Queries\QueryFilters\PriceFilter;
use App\Queries\QueryFilters\SlugFilter;
use App\Queries\QueryFilters\SortFilter;
use App\Queries\QueryFilters\VisibilityFilter;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Pipeline;

class SearchTours
{
    public static function execute(SearchData $searchData): LengthAwarePaginator
    {
        return Pipeline::send(GiveMeTravels::query($searchData))
            ->through([
                VisibilityFilter::class,
                SlugFilter::class,
                PriceFilter::class,
                DateFilter::class,
                SortFilter::class,
            ])
            ->thenReturn()
            /**
             * @phpstan-ignore-next-line
             */
            ->paginate(10);
    }
}
