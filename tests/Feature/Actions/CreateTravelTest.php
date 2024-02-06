<?php

use App\Actions\CreateTravel;
use App\Data\Travel\TravelCreationData;
use App\Models\Travel;

it('creates a travel', function () {

    $travelCreationData = TravelCreationData::from([
        'name' => 'Travel Name',
        'description' => 'travel description',
        'numberOfDays' => 2,
        'moods' => [
            [
                'name' => 'Mood 1',
                'value' => 1,
            ],
            [
                'name' => 'Mood 2',
                'value' => 2,
            ],
        ],
    ]);

    $travel = CreateTravel::execute($travelCreationData);

    expect($travel)->toBeInstanceOf(Travel::class);

});

it('creates a travel with no moods', function () {

    $travelCreationData = TravelCreationData::from([
        'name' => 'Travel Name',
        'description' => 'travel description',
        'numberOfDays' => 2,
    ]);

    $travel = CreateTravel::execute($travelCreationData);

    expect($travel)->toBeInstanceOf(Travel::class);

});

it('creates a travel with moods', function () {

    $travelCreationData = TravelCreationData::from([
        'name' => 'Travel Name',
        'description' => 'travel description',
        'numberOfDays' => 2,
        'moods' => [
            [
                'name' => 'Mood 1',
                'value' => 1,
            ],
            [
                'name' => 'Mood 2',
                'value' => 2,
            ],
        ],
    ]);

    $travel = CreateTravel::execute($travelCreationData);

    expect($travel)->toBeInstanceOf(Travel::class)
        ->moods->toHaveCount(2)
        ->and($travel->moods->first())->name->toBe('Mood 1')
        ->and($travel->moods->first())->pivot->value->toBe(1)
        ->and($travel->moods->last())->name->toBe('Mood 2')
        ->and($travel->moods->last())->pivot->value->toBe(2);


});
