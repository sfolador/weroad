<?php

namespace App\Actions;

use App\Data\MoodData;
use App\Data\Tour\TourCreationData;
use App\Data\Travel\TravelCreationData;
use App\Models\Mood;
use App\Models\Tour;
use App\Models\Travel;

class CreateTour
{
    /**
     * @param TourCreationData $tourCreationData
     * @return Tour
     */
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
