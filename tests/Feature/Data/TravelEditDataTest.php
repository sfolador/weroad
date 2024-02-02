<?php

use App\Data\Travel\TravelEditData;
use Illuminate\Validation\ValidationException;

it('can have a name', function () {
    $travelEditData = TravelEditData::from([
        'name' => 'Travel name',
    ]);

    expect($travelEditData->name)->toBe('Travel name');
});

it('can have a description', function () {
    $travelEditData = TravelEditData::from([
        'description' => 'Travel description',
    ]);

    expect($travelEditData->description)->toBe('Travel description');
});

it('can have a number of days', function () {
    $travelEditData = TravelEditData::from([
        'numberOfDays' => 5,
    ]);

    expect($travelEditData->numberOfDays)->toBe(5);
});

it('can have moods', function () {

    $moods = [
        ['name' => 'Mood 1', 'value' => 5],
        ['name' => 'Mood 2', 'value' => 3],
    ];
    $travelEditData = TravelEditData::from([
        'moods' => $moods,
    ]);

    expect($travelEditData->moods->count())->toBe(2)
        ->and($travelEditData->moods[0]->name)->toBe('Mood 1')
        ->and($travelEditData->moods[0]->value)->toBe(5)
        ->and($travelEditData->moods[1]->name)->toBe('Mood 2')
        ->and($travelEditData->moods[1]->value)->toBe(3);
});

it('the name must be at least 3 characters long', function () {
    TravelEditData::validate([
        'name' => 'H',
    ]);
})->throws(ValidationException::class, 'The name field must be at least 3 characters.');

it('the name must be less than 128 characters long', function () {
    TravelEditData::validate([
        'name' => Str::random(129),

    ]);
})->throws(ValidationException::class, 'The name field must not be greater than 128 characters.');

it('the description must be at least 3 characters long', function () {
    TravelEditData::validate([
        'description' => 'D',
    ]);
})->throws(ValidationException::class, 'The description field must be at least 3 characters.');

it('the description must be less than 1000 characters long', function () {
    TravelEditData::validate([

        'description' => Str::random(1001),

    ]);
})->throws(ValidationException::class, 'The description field must not be greater than 1000 characters.');

it('the number of days must be at least 1', function () {
    TravelEditData::validate([

        'numberOfDays' => 0,

    ]);
})->throws(ValidationException::class, 'The number of days field must be at least 1.');

it('the number of days must be at most 365', function () {
    TravelEditData::validate([

        'numberOfDays' => 366,

    ]);
})->throws(ValidationException::class, 'The number of days field must not be greater than 365.');
