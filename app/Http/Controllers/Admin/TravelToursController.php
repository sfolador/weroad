<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CreateTour;
use App\Data\Tour\TourCreationData;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
use App\Models\Travel;

class TravelToursController extends Controller
{
    /**
     * @param Travel $travel
     * @param TourCreationData $tourCreationData
     * @return TourResource
     */
    public function store(Travel $travel, TourCreationData $tourCreationData): TourResource
    {

        $tour = CreateTour::execute($tourCreationData);
        return new TourResource($tour);
    }
}
