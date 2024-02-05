<?php

namespace App\Http\Controllers\Guest;

use App\Actions\Search\SearchTours;
use App\Data\Search\SearchData;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
use App\Queries\GiveMeTravels;
use App\Queries\QueryFilters\DateFilter;
use App\Queries\QueryFilters\PriceFilter;
use App\Queries\QueryFilters\SlugFilter;
use App\Queries\QueryFilters\SortFilter;
use App\Queries\QueryFilters\VisibilityFilter;
use Illuminate\Support\Facades\Pipeline;

class TravelsController extends Controller
{
    public function search(SearchData $data)
    {
        $travels = SearchTours::execute($data);

        return TourResource::collection($travels);
    }
}
