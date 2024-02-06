<?php

use App\Models\Travel;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('can create a travel', function () {
    Sanctum::actingAs(
        User::factory()->admin()->create(),
        ['*']
    );

    $response = $this->postJson(route('travels.store'), [
        'name' => 'Travel Name',
        'slug' => 'travel_name',
        'description' => 'Travel Description',
        'numberOfDays' => 4,
    ]);

    $response->assertCreated();
});

it('cannot create a travel as an editor', function () {
    Sanctum::actingAs(
        User::factory()->editor()->create(),
        ['*']
    );

    $response = $this->postJson(route('travels.store'), [
        'name' => 'Travel Name',
        'slug' => 'travel_name',
        'description' => 'Travel Description',
        'numberOfDays' => 4,
    ]);

    $response->assertForbidden();
});

it('cannot create a travel if not logged', function () {

    $response = $this->postJson(route('travels.store'), [
        'name' => 'Travel Name',
        'slug' => 'travel_name',
        'description' => 'Travel Description',
        'numberOfDays' => 4,
    ]);

    $response->assertUnauthorized();
});

it('an editor can edit a travel', function () {
    Sanctum::actingAs(
        User::factory()->editor()->create(),
        ['*']
    );

    $travel = Travel::factory()->create([
        'name' => 'Travel Name',
    ]);

    $response = $this->putJson(route('travels.edit', ['travel' => $travel]), [
        'name' => 'Other Travel Name',
    ]);

    $response->assertOk();

    $travel->refresh();

    expect($travel->name)->toBe('Other Travel Name');
});

it('an admin cannot edit a travel', function () {
    Sanctum::actingAs(
        User::factory()->admin()->create(),
        ['*']
    );

    $travel = Travel::factory()->create([
        'name' => 'Travel Name',
    ]);

    $response = $this->putJson(route('travels.edit', ['travel' => $travel]), [
        'name' => 'Other Travel Name',
    ]);

    $response->assertForbidden();
});
