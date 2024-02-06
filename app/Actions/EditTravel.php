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

        $moods = $travelEditData->moods;

        if ($moods) {
            $travel->moods()->detach();

            $moods->each(function (MoodData $moodData) use ($travel) {

                $mood = Mood::where('name', $moodData->name)->first();
                if (! $mood) {
                    $mood = new Mood();
                    $mood->name = $moodData->name;
                    $mood->save();
                }
                $travel->moods()->attach($mood->id, ['value' => $moodData->value]);

            });
        }

        return $travel;

    }
}
