<?php

use App\Models\Travel;
use App\Rules\NumberOfDaysRule;
use Illuminate\Validation\ValidationException;

it('fails if number of days is not correct', function () {

    $travel = Travel::factory()->create([
        'numberOfDays' => 5,
    ]);
    $data = [
        'startingDate' => '2021-01-01',
        'travel' => $travel->id,
        'endingDate' => '2021-01-03',
    ];

    Validator::validate($data, [
        'endingDate' => ['required', 'date', new NumberOfDaysRule],
    ]);
})->throws(ValidationException::class, 'The number of days must be equal to the number of days from the travel (5).');

it('a travel is required', function () {

    $data = [
        'startingDate' => '2021-01-01',
        'endingDate' => '2021-01-03',
    ];

    Validator::validate($data, [
        'endingDate' => ['required', 'date', new NumberOfDaysRule],
    ]);
})->throws(ValidationException::class, 'The travel is required.');

it('a valid travel is required', function () {

    $data = [
        'startingDate' => '2021-01-01',
        'travel' => fake()->uuid,
        'endingDate' => '2021-01-03',
    ];

    Validator::validate($data, [
        'endingDate' => ['required', 'date', new NumberOfDaysRule],
    ]);
})->throws(ValidationException::class, 'The travel is invalid.');

it('a valid starting Date is required', function () {

    $data = [
        'travel' => fake()->uuid,
        'endingDate' => '2021-01-03',
    ];

    Validator::validate($data, [
        'endingDate' => ['required', 'date', new NumberOfDaysRule],
    ]);
})->throws(ValidationException::class, 'The starting date is required.');

it('success if number of days is correct', function () {

    $travel = Travel::factory()->create([
        'numberOfDays' => 2,
    ]);
    $data = [
        'startingDate' => '2021-01-01',
        'travel' => $travel->id,
        'endingDate' => '2021-01-03',
    ];

    $validator = Validator::make($data, [
        'endingDate' => ['required', 'date', new NumberOfDaysRule],
    ]);

    expect($validator->passes())->toBeTrue();
});
