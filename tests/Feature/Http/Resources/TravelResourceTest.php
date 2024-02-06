<?php

use App\Http\Resources\TravelResource;
use App\Models\Travel;

it('has an id', function () {

    $travel = Travel::factory()->create();

    $resource = new TravelResource($travel);

    expect($resource->toArray(request()))->toHaveKey('id', $travel->id);

});

it('has a slug', function () {

    $travel = Travel::factory()->create();

    $resource = new TravelResource($travel);

    expect($resource->toArray(request()))->toHaveKey('slug', $travel->slug);

});

it('has a name', function () {

    $travel = Travel::factory()->create();

    $resource = new TravelResource($travel);

    expect($resource->toArray(request()))->toHaveKey('name', $travel->name);

});

it('has a description', function () {

    $travel = Travel::factory()->create();

    $resource = new TravelResource($travel);

    expect($resource->toArray(request()))->toHaveKey('description', $travel->description);
});

it('has a number of days', function () {

    $travel = Travel::factory()->create();

    $resource = new TravelResource($travel);

    expect($resource->toArray(request()))->toHaveKey('numberOfDays', $travel->numberOfDays);
});
