<?php

namespace App\Actions;

use App\Data\Tour\TourCreationData;
use App\Models\Tour;

class CreateTour
{
    public static function execute(TourCreationData $tourCreationData): Tour
    {

        $tour = new Tour();
        $tour->name = $tourCreationData->name;
        $tour->travel_id = $tourCreationData->travel;
        $tour->startingDate = $tourCreationData->startingDate;
        $tour->endingDate = $tourCreationData->endingDate;
        $tour->price = $tourCreationData->price;
        $tour->save();

        return $tour;

    }
}
