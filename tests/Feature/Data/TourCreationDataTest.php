<?php

/**
 * #[StringType, Min(3), Max(128)]
 * public string $name,
 * #[Uuid, Exists('travels', 'id')]
 * public string $travel,
 * #[WithCast(DateTimeInterfaceCast::class, type: Carbon::class), AfterOrEqual('today')]
 * public Carbon $startingDate,
 * #[WithCast(DateTimeInterfaceCast::class, type: Carbon::class), AfterOrEqual('today'),Rule('number_of_days')]
 * public Carbon $endingDate,
 * public int $price
 */

use App\Data\Tour\TourCreationData;
use App\Models\Travel;
use Illuminate\Validation\ValidationException;

it('has a name', function () {

    $travel = Travel::factory()->create([
        'numberOfDays' => 5,
    ]);

    $tourCreationData = TourCreationData::from([
        'name' => 'Tour name',
        'travel' => $travel->id,
        'startingDate' => now(),
        'endingDate' => now()->addDays(5),
        'price' => 1000,

    ]);

    expect($tourCreationData->name)->toBe('Tour name');
});

it('has a travel', function () {

    $travel = Travel::factory()->create([
        'numberOfDays' => 5,
    ]);

    $tourCreationData = TourCreationData::from([
        'name' => 'Tour name',
        'travel' => $travel->id,
        'startingDate' => now(),
        'endingDate' => now()->addDays(5),
        'price' => 1000,

    ]);

    expect($tourCreationData->travel)->toBe($travel->id);
});

it('has a starting date', function () {

    $travel = Travel::factory()->create([
        'numberOfDays' => 5,
    ]);

    $startingDate = now();
    $tourCreationData = TourCreationData::from([
        'name' => 'Tour name',
        'travel' => $travel->id,
        'startingDate' => $startingDate,
        'endingDate' => now()->addDays(5),
        'price' => 1000,

    ]);

    expect($tourCreationData->startingDate)->toBe($startingDate);
});

it('has a ending date', function () {

    $travel = Travel::factory()->create([
        'numberOfDays' => 5,
    ]);

    $endingDate = now()->addDays(5);

    $tourCreationData = TourCreationData::from([
        'name' => 'Tour name',
        'travel' => $travel->id,
        'startingDate' => now(),
        'endingDate' => $endingDate,
        'price' => 1000,

    ]);

    expect($tourCreationData->endingDate)->toBe($endingDate);
});

it('has a price', function () {

    $travel = Travel::factory()->create([
        'numberOfDays' => 5,
    ]);

    $tourCreationData = TourCreationData::from([
        'name' => 'Tour name',
        'travel' => $travel->id,
        'startingDate' => now(),
        'endingDate' => now()->addDays(5),
        'price' => 1000,

    ]);

    expect($tourCreationData->price)->toBe(1000);
});

it('the name must be at least 3 characters long', function () {
    $travel = Travel::factory()->create([
        'numberOfDays' => 5,
    ]);
    TourCreationData::validate([
        'name' => 'H',
        'travel' => $travel->id,
        'startingDate' => now(),
        'endingDate' => now()->addDays(5),
        'price' => 1000,

    ]);
})->throws(ValidationException::class, 'The name field must be at least 3 characters.');

it('the name must be less than 128 characters long', function () {
    $travel = Travel::factory()->create([
        'numberOfDays' => 5,
    ]);
    TourCreationData::validate([
        'name' => Str::random(129),
        'travel' => $travel->id,
        'startingDate' => now(),
        'endingDate' => now()->addDays(5),
        'price' => 1000,

    ]);
})->throws(ValidationException::class, 'The name field must not be greater than 128 characters.');

it('the price must be at least 0', function () {
    $travel = Travel::factory()->create([
        'numberOfDays' => 5,
    ]);
    TourCreationData::validate([
        'name' => 'Tour name',
        'travel' => $travel->id,
        'startingDate' => now(),
        'endingDate' => now()->addDays(5),
        'price' => -1,

    ]);
})->throws(ValidationException::class, 'The price field must be at least 0.');

it('the travel must exist', function () {
    try {
        TourCreationData::validate([
            'name' => 'Tour name',
            'travel' => fake()->uuid,
            'startingDate' => now(),
            'endingDate' => now()->addDays(5),
            'price' => 1000,

        ]);
    } catch (ValidationException $e) {

        expect($e->validator->errors()->first('travel'))->toBe('The selected travel is invalid.')
            ->and($e->validator->errors()->first('endingDate'))->toBe('The travel is invalid.');
    }
});

it('the starting date must be after or equal to today', function () {
    $travel = Travel::factory()->create([
        'numberOfDays' => 5,
    ]);
    try {
        TourCreationData::validate([
            'name' => 'Tour name',
            'travel' => $travel->id,
            'startingDate' => now()->subDay(),
            'endingDate' => now()->addDays(5),
            'price' => 1000,

        ]);
    } catch (ValidationException $e) {

        expect($e->validator->errors()->first('startingDate'))->toBe('The starting date field must be a date after or equal to today.')
            ->and($e->validator->errors()->first('endingDate'))->toBe('The number of days must be equal to the number of days from the travel (5).');
    }

});

it('the ending date must be after or equal to today', function () {
    $travel = Travel::factory()->create([
        'numberOfDays' => 5,
    ]);
    try {
        TourCreationData::validate([
            'name' => 'Tour name',
            'travel' => $travel->id,
            'startingDate' => now(),
            'endingDate' => now()->subDay(),
            'price' => 1000,

        ]);
    } catch (ValidationException $e) {

        expect($e->validator->errors()->first('endingDate'))->toBe('The ending date field must be a date after or equal to today.');
    }

});

it('the difference between dates must be the number of days of the travel', function () {
    $travel = Travel::factory()->create([
        'numberOfDays' => 5,
    ]);
    try {
        TourCreationData::validate([
            'name' => 'Tour name',
            'travel' => $travel->id,
            'startingDate' => now(),
            'endingDate' => now()->addDays(4),
            'price' => 1000,

        ]);
    } catch (ValidationException $e) {

        expect($e->validator->errors()->first('endingDate'))->toBe('The number of days must be equal to the number of days from the travel (5).');
    }

});
