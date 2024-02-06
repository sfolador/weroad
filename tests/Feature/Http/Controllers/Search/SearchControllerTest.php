<?php

use App\Models\Tour;
use App\Models\Travel;

beforeEach(function () {
    $this->travel = Travel::factory()->public()->create();

    $this->tour_one = Tour::factory()->create([
        'travel_id' => $this->travel->id,
        'price' => 800,
        'startingDate' => now()->addDays(2),
        'endingDate' => now()->addDays(4),
    ]);

    $this->tour_two = Tour::factory()->create([
        'travel_id' => $this->travel->id,
        'price' => 1000,
        'startingDate' => now()->addDays(5),
        'endingDate' => now()->addDays(7),
    ]);
});

it('can search tours', function () {
    $response = $this->postJson(route('search'), [
        'slug' => $this->travel->slug,
    ]);

    $response->assertOk();
});

it('can search tours by starting date', function () {
    $response = $this->postJson(route('search'), [
        'slug' => $this->travel->slug,
        'dateFrom' => now()->format('Y-m-d'),
    ]);

    $response->assertOk();
    expect($response->json('data'))->toHaveCount(2);
});

it('can search tours by ending date', function () {
    $response = $this->postJson(route('search'), [
        'slug' => $this->travel->slug,
        'dateTo' => now()->addDays(5)->format('Y-m-d'),
    ]);

    $response->assertOk();
    expect($response->json('data'))->toHaveCount(2);
});

it('can search tours by price ', function () {
    $response = $this->postJson(route('search'), [
        'slug' => $this->travel->slug,
        'priceFrom' => 1000,
    ]);

    $response->assertOk();

    expect($response->json('data'))->toHaveCount(1)
        ->and($response->json('data.0.id'))->toBe($this->tour_two->id);
});

it('can search tours by price range', function () {
    $response = $this->postJson(route('search'), [
        'slug' => $this->travel->slug,
        'priceFrom' => 800,
        'priceTo' => 1000,
    ]);

    $response->assertOk();

    expect($response->json('data'))->toHaveCount(2);
});

it('can search tours by price range and date range', function () {
    $response = $this->postJson(route('search'), [
        'slug' => $this->travel->slug,
        'priceFrom' => 800,
        'priceTo' => 1000,
        'dateFrom' => now()->addDays(2)->format('Y-m-d'),
        'dateTo' => now()->addDays(5)->format('Y-m-d'),
    ]);

    $response->assertOk();

    expect($response->json('data'))->toHaveCount(2)
        ->and($response->json('data.0.id'))->toBe($this->tour_one->id);
});

it('can search tours by price range and date range and sort by price', function () {
    $response = $this->postJson(route('search'), [
        'slug' => $this->travel->slug,
        'priceFrom' => 800,
        'priceTo' => 1000,
        'dateFrom' => now()->addDays(2)->format('Y-m-d'),
        'dateTo' => now()->addDays(5)->format('Y-m-d'),
        'sortDirection' => 'desc',
    ]);

    $response->assertOk();

    expect($response->json('data'))->toHaveCount(2)
        ->and($response->json('data.0.id'))->toBe($this->tour_two->id);
});
