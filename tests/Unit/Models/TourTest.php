<?php

use App\Models\Tour;
use Illuminate\Support\Carbon;

it('has an uuid', function () {

    $tour = Tour::factory()->create();
    expect($tour->id)->toBeUuid();

});

it('has a travel_id', function () {
    $tour = Tour::factory()->create();
    expect($tour->travel_id)->toBeString();
});

it('has a name', function () {
    $tour = Tour::factory()->create();
    expect($tour->name)->toBeString();
});

it('has a startingDate', function () {
    $tour = Tour::factory()->create();
    expect($tour->startingDate)->toBeInstanceOf(Carbon::class);
});

it('has a endingDate', function () {
    $tour = Tour::factory()->create();
    expect($tour->endingDate)->toBeInstanceOf(Carbon::class);
});

it('has a price', function () {
    $tour = Tour::factory()->create();
    expect($tour->price)->toBeNumeric();
});
