<?php

namespace App\Http\Controllers\Guest;

use App\Data\Search\SearchData;
use App\Http\Controllers\Controller;
use App\Queries\GiveMeTravels;
use App\Queries\QueryFilters\DateFilter;
use App\Queries\QueryFilters\PriceFilter;
use App\Queries\QueryFilters\SlugFilter;
use App\Queries\QueryFilters\SortFilter;
use Illuminate\Support\Facades\Pipeline;

class TravelsController extends Controller
{
    public function search(SearchData $data)
    {
        $travels = Pipeline::send(GiveMeTravels::query($data))
            ->through([
                SlugFilter::class,
                PriceFilter::class,
                DateFilter::class,
                SortFilter::class,
            ])
            ->thenReturn()
            ->paginate(10);

        return $travels;
    }
}
