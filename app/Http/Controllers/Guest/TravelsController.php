<?php

namespace App\Http\Controllers\Guest;

use App\Actions\Search\SearchTours;
use App\Data\Search\SearchData;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TravelsController extends Controller
{
    public function search(SearchData $data): AnonymousResourceCollection
    {

        $travels = SearchTours::execute($data);

        return TourResource::collection($travels);
    }
}
