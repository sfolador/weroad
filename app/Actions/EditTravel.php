<?php

namespace App\Actions;

use App\Data\MoodData;
use App\Data\Travel\TravelEditData;
use App\Models\Mood;
use App\Models\Travel;
use Illuminate\Support\Str;
use Spatie\LaravelData\Optional;

class EditTravel
{
    public static function execute(Travel $travel, TravelEditData $travelEditData): Travel
    {

        if (! ($travelEditData->name instanceof Optional)) {
            $travel->slug = Str::slug($travelEditData->name, '_');
            $travel->name = $travelEditData->name;
        }

        if (! ($travelEditData->description instanceof Optional)) {
            $travel->description = $travelEditData->description;
        }

        if (! ($travelEditData->numberOfDays instanceof Optional)) {
            $travel->numberOfDays = $travelEditData->numberOfDays;

        }
        $travel->save();

        $moods = $travel->moods;

        //        $moods->each(function (MoodData $moodData) {
        //            $mood = new Mood();
        //            $mood->name = $moodData->name;
        //            $mood->value = $moodData->value;
        //            $mood->save();
        //        });

        return $travel;

    }
}
