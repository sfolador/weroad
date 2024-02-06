<?php

use App\Http\Resources\TourResource;
use App\Models\Tour;

it('has an id', function () {
    $tour = Tour::factory()->create();
    $resource = new TourResource($tour);
    expect($resource->toArray(request()))->toHaveKey('id', $tour->id);
});

it('has a name', function () {
    $tour = Tour::factory()->create();
    $resource = new TourResource($tour);
    expect($resource->toArray(request()))->toHaveKey('name', $tour->name);
});

it('has a starting date', function () {
    $tour = Tour::factory()->create();
    $resource = new TourResource($tour);
    expect($resource->toArray(request()))->toHaveKey('startingDate', $tour->startingDate->format('Y-m-d'));
});

it('has an ending date', function () {
    $tour = Tour::factory()->create();
    $resource = new TourResource($tour);
    expect($resource->toArray(request()))->toHaveKey('endingDate', $tour->endingDate->format('Y-m-d'));
});

it('has a price', function () {
    $tour = Tour::factory()->create();
    $resource = new TourResource($tour);
    expect($resource->toArray(request()))->toHaveKey('price', $tour->price);
});

it('has a travel id', function () {
    $tour = Tour::factory()->create();
    $resource = new TourResource($tour);
    expect($resource->toArray(request()))->toHaveKey('travel_id', $tour->travel_id);
});
