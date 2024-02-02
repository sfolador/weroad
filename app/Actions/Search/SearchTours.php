<?php

namespace App\Actions\Search;

use App\Data\Search\SearchData;
use App\Queries\GiveMeTravels;
use App\Queries\QueryFilters\DateFilter;
use App\Queries\QueryFilters\PriceFilter;
use App\Queries\QueryFilters\SlugFilter;
use App\Queries\QueryFilters\SortFilter;
use Illuminate\Support\Facades\Pipeline;

class SearchTours
{
    public function execute(SearchData $searchData)
    {
        return Pipeline::send(GiveMeTravels::query($searchData))
            ->through([
                SlugFilter::class,
                PriceFilter::class,
                DateFilter::class,
                SortFilter::class,
            ])
            ->thenReturn()
            ->paginate(10);
    }
}
