<?php

namespace App\Actions;

use App\Data\MoodData;
use App\Data\Travel\TravelCreationData;
use App\Models\Mood;
use App\Models\Travel;
use Illuminate\Support\Str;

class CreateTravel
{
    public static function execute(TravelCreationData $travelCreationData): Travel
    {

        $travel = new Travel();
        $travel->name = $travelCreationData->name;
        $travel->slug = Str::slug($travelCreationData->name, '_');
        $travel->description = $travelCreationData->description;
        $travel->numberOfDays = $travelCreationData->numberOfDays;
        $travel->save();

        $moods = $travelCreationData->moods;

        //        $moods->each(function (MoodData $moodData) {
        //            $mood = new Mood();
        //            $mood->name = $moodData->name;
        //            $mood->value = $moodData->value;
        //            $mood->save();
        //        });

        return $travel;

    }
}
