<?php

use App\Actions\EditTravel;
use App\Data\Travel\TravelEditData;
use App\Models\Travel;

it('edits a travel number of days', function () {

    $travel = Travel::factory()->create([
        'name' => 'Travel Name',
        'description' => 'travel description',
        'numberOfDays' => 2,
    ]);

    $travelEditData = TravelEditData::from([
        'numberOfDays' => 3,
    ]);

    $travel = EditTravel::execute($travel, $travelEditData);

    expect($travel)->toBeInstanceOf(Travel::class)
        ->numberOfDays->toBe(3);

});

it('edits a travel name', function () {
    $otherName = 'Other Travel Name';
    $travel = Travel::factory()->create([
        'name' => 'Travel Name',
        'description' => 'travel description',
        'numberOfDays' => 2,
    ]);

    $travelEditData = TravelEditData::from([
        'name' => $otherName,
    ]);

    $travel = EditTravel::execute($travel, $travelEditData);

    expect($travel)->toBeInstanceOf(Travel::class)
        ->name->toBe($otherName);

});

it('edits a travel description', function () {
    $description = 'Other Travel Description';
    $travel = Travel::factory()->create([
        'name' => 'Travel Name',
        'description' => 'travel description',
        'numberOfDays' => 2,
    ]);

    $travelEditData = TravelEditData::from([
        'description' => $description,
    ]);

    $travel = EditTravel::execute($travel, $travelEditData);

    expect($travel)->toBeInstanceOf(Travel::class)
        ->description->toBe($description);

});
