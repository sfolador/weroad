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

it('has number of nights', function () {
    $travel = Travel::factory()->create();
    expect($travel->numberOfNights)->toBeInt()
        ->toEqual($travel->numberOfDays - 1);
});

it('updates the number of nights when the number of days is updated', function () {
    $travel = Travel::factory()->create([
        'numberOfDays' => 5,
    ]);

    expect($travel->numberOfNights)->toEqual(4);

    $travel->update(['numberOfDays' => 10]);
    expect($travel->numberOfNights)->toEqual(9);
});

it('has a public flag', function () {
    $travel = Travel::factory()->create();
    expect($travel->public)->toBeBool();
});

it('can be public', function () {
    $travel = Travel::factory()->public()->create();
    expect($travel->isPublic())->toBeTrue();
});

it('can be private', function () {
    $travel = Travel::factory()->private()->create();
    expect($travel->isPublic())->toBeFalse();
});
