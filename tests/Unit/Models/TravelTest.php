<?php

use App\Models\Travel;

it('has a uuid', function () {
    $travel = Travel::factory()->create();
    expect($travel->id)->toBeUuid();
});

it('has a slug', function () {
    $travel = Travel::factory()->create();
    expect($travel->slug)->toBeString();
});

it('has a name', function () {
    $travel = Travel::factory()->create();
    expect($travel->name)->toBeString();
});

it('has a description', function () {
    $travel = Travel::factory()->create();
    expect($travel->description)->toBeString();
});

it('has a numberOfDays', function () {
    $travel = Travel::factory()->create();
    expect($travel->numberOfDays)->toBeInt();
});
