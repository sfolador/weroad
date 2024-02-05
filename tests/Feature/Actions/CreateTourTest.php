<?php

use App\Actions\CreateTour;
use App\Data\Tour\TourCreationData;
use App\Models\Tour;
use App\Models\Travel;

it('creates a tour', function () {
    $travel = Travel::factory()->create();

    $tourCreationData = TourCreationData::from([
        'name' => 'Tour Name',
        'travel' => $travel->id,
        'startingDate' => now(),
        'endingDate' => now()->addDays(5),
        'price' => 1000
    ]);

    $tour = CreateTour::execute($tourCreationData);

    expect($tour)->toBeInstanceOf(Tour::class);

});
