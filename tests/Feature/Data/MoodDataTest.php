<?php

use App\Data\MoodData;
use Illuminate\Validation\ValidationException;

it('has a name', function () {

    $name = 'Happy';
    $moodData = MoodData::from([
        'name' => $name,
        'value' => 5
    ]);

    expect($moodData->name)->toBe($name);

});



it('has a value', function () {

    $value = 20;
    $moodData = MoodData::from([
        'name' => 'Happy',
        'value' => $value
    ]);

    expect($moodData->value)->toBe($value);

});


it('the name must be longer than 3 characters', function () {

   MoodData::validate([
        'name' => 'H',
        'value' => 5
    ]);

})->throws(ValidationException::class, 'The name field must be at least 3 characters.');

it('the name must be shorter than 128 characters', function () {

    MoodData::validate([
        'name' => Str::random(200),
        'value' => 5
    ]);

})->throws(ValidationException::class, 'The name field must not be greater than 128 characters.');


it('the value must be at least 0', function () {

    MoodData::validate([
        'name' => 'Happy',
        'value' => -1
    ]);

})->throws(ValidationException::class, 'The value field must be at least 0.');


it('the value must be maximum 100', function () {

    MoodData::validate([
        'name' => 'Happy',
        'value' => 101
    ]);

})->throws(ValidationException::class, 'The value field must not be greater than 100.');
