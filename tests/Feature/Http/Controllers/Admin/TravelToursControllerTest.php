<?php

use App\Models\Travel;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('can create a tour', function () {
    Sanctum::actingAs(
        User::factory()->admin()->create(),
        ['*']
    );

    $travel = Travel::factory()->create([
        'numberOfDays' => 3,
    ]);

    $response = $this->postJson(route('travels.tours.store', $travel), [
        'name' => 'Tour Name',
        'travel' => $travel->id,
        'startingDate' => now()->addDays(2)->format('Y-m-d'),
        'endingDate' => now()->addDays(5)->format('Y-m-d'),
        'description' => 'Tour Description',
        'price' => 1000,
    ]);

    $response->assertCreated();
});

it('an editor cannot create a tour', function () {
    Sanctum::actingAs(
        User::factory()->editor()->create(),
        ['*']
    );

    $travel = Travel::factory()->create([
        'numberOfDays' => 3,
    ]);

    $response = $this->postJson(route('travels.tours.store', $travel), [
        'name' => 'Tour Name',
        'travel' => $travel->id,
        'startingDate' => now()->addDays(2)->format('Y-m-d'),
        'endingDate' => now()->addDays(5)->format('Y-m-d'),
        'description' => 'Tour Description',
        'price' => 1000,
    ]);

    $response->assertForbidden();
});
