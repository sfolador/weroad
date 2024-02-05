<?php

use App\Actions\CreateTour;
use App\Actions\CreateTravel;
use App\Data\Tour\TourCreationData;
use App\Data\Travel\TravelCreationData;
use App\Models\Tour;
use App\Models\Travel;

it('creates a travel', function () {

    $travelCreationData = TravelCreationData::from([
        'name' => 'Travel Name',
        'description' => 'travel description',
        'numberOfDays' =>  2,
        'moods' => [
            [
                'name' => 'Mood 1',
                'value' => 1
            ],
            [
                'name' => 'Mood 2',
                'value' => 2
            ]
        ]
    ]);

    $travel = CreateTravel::execute($travelCreationData);

    expect($travel)->toBeInstanceOf(Travel::class);

});
