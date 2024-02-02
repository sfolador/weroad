<?php

//public string $name,
//        public string $description,
//        public int $numberOfDays,
//        #[DataCollectionOf(MoodData::class)]
//        public DataCollection $moods,

use App\Data\Travel\TravelCreationData;
use Illuminate\Validation\ValidationException;

it('has a name', function () {
    $name = 'Happy';
    $travelCreationData = TravelCreationData::from([
        'name' => $name,
        'description' => 'description',
        'numberOfDays' => 5,
        'moods' => [
            ['name' => 'Happy', 'value' => 5],
        ],
    ]);

    expect($travelCreationData->name)->toBe($name);
});

it('has a description', function () {
    $description = 'description';
    $travelCreationData = TravelCreationData::from([
        'name' => 'Happy',
        'description' => $description,
        'numberOfDays' => 5,
        'moods' => [
            ['name' => 'Happy', 'value' => 5],
        ],
    ]);

    expect($travelCreationData->description)->toBe($description);
});

it('has a number of days', function () {
    $numberOfDays = 7;
    $travelCreationData = TravelCreationData::from([
        'name' => 'Happy',
        'description' => 'description',
        'numberOfDays' => $numberOfDays,
        'moods' => [
            ['name' => 'Happy', 'value' => 5],
        ],
    ]);

    expect($travelCreationData->numberOfDays)->toBe($numberOfDays);
});

it('has moods', function () {
    $moods = [
        ['name' => 'Happy', 'value' => 5],
        ['name' => 'Sad', 'value' => 1],
    ];
    $travelCreationData = TravelCreationData::from([
        'name' => 'Happy',
        'description' => 'description',
        'numberOfDays' => 5,
        'moods' => $moods,
    ]);

    expect($travelCreationData->moods->count())->toBe(2)
        ->and($travelCreationData->moods[0]->name)->toBe('Happy')
        ->and($travelCreationData->moods[0]->value)->toBe(5)
        ->and($travelCreationData->moods[1]->name)->toBe('Sad')
        ->and($travelCreationData->moods[1]->value)->toBe(1);
});

it('the name must be at least 3 characters long', function () {
    TravelCreationData::validate([
        'name' => 'H',
        'description' => 'description',
        'numberOfDays' => 5,
        'moods' => [
            ['name' => 'Happy', 'value' => 5],
        ],
    ]);
})->throws(ValidationException::class, 'The name field must be at least 3 characters.');

it('the name must be less than 128 characters long', function () {
    TravelCreationData::validate([
        'name' => Str::random(129),
        'description' => 'description',
        'numberOfDays' => 5,
        'moods' => [
            ['name' => 'Happy', 'value' => 5],
        ],
    ]);
})->throws(ValidationException::class, 'The name field must not be greater than 128 characters.');

it('the description must be at least 3 characters long', function () {
    TravelCreationData::validate([
        'name' => 'Hello',
        'description' => 'D',
        'numberOfDays' => 5,
        'moods' => [
            ['name' => 'Happy', 'value' => 5],
        ],
    ]);
})->throws(ValidationException::class, 'The description field must be at least 3 characters.');

it('the description must be less than 1000 characters long', function () {
    TravelCreationData::validate([
        'name' => 'Hello',
        'description' => Str::random(1001),
        'numberOfDays' => 5,
        'moods' => [
            ['name' => 'Happy', 'value' => 5],
        ],
    ]);
})->throws(ValidationException::class, 'The description field must not be greater than 1000 characters.');

it('the number of days must be at least 1', function () {
    TravelCreationData::validate([
        'name' => 'Hello',
        'description' => 'description',
        'numberOfDays' => 0,
        'moods' => [
            ['name' => 'Happy', 'value' => 5],
        ],
    ]);
})->throws(ValidationException::class, 'The number of days field must be at least 1.');

it('the number of days must be at most 365', function () {
    TravelCreationData::validate([
        'name' => 'Hello',
        'description' => 'description',
        'numberOfDays' => 366,
        'moods' => [
            ['name' => 'Happy', 'value' => 5],
        ],
    ]);
})->throws(ValidationException::class, 'The number of days field must not be greater than 365.');
