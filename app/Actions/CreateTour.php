<?php

namespace App\Actions;

use App\Data\MoodData;
use App\Data\Travel\TravelCreationData;
use App\Models\Mood;
use App\Models\Travel;

class CreateTour
{
    public static function execute(TravelCreationData $travelCreationData)
    {

        $travel = new Travel();
        $travel->name = $travelCreationData->name;
        $travel->description = $travelCreationData->description;
        $travel->numberOfDays = $travelCreationData->numberOfDays;
        $travel->save();

        $moods = $travelCreationData->moods;

        $moods->each(function (MoodData $moodData) {
            $mood = new Mood();
            $mood->name = $moodData->name;
            $mood->value = $moodData->value;
            $mood->save();
        });

    }
}
