<?php

use App\Data\Search\SearchData;
use App\Models\Tour;
use App\Models\Travel;
use App\Queries\GiveMeTravels;

beforeEach(function () {
    $this->travel = Travel::factory()->create([
        'slug' => 'slug',
    ]);
    $this->travel_two = Travel::factory()->create([
        'slug' => 'slug_2',
    ]);
    $this->travel_three = Travel::factory()->create([
        'slug' => 'slug_3',
    ]);

    Tour::factory()->create([
        'travel_id' => $this->travel->id,
    ]);
    Tour::factory()->create([
        'travel_id' => $this->travel_two->id,
    ]);
    Tour::factory()->create([
        'travel_id' => $this->travel_three->id,
    ]);
});

it('returns all tours', function () {

    $searchData = SearchData::from([]);

    $results = GiveMeTravels::query($searchData)->get();

    expect($results)->each->toBeInstanceOf(Tour::class)
        ->and($results->count())->toBe(3);
});

it('can have a pipeline', function () {
    $searchData = SearchData::from([]);

    $results = GiveMeTravels::query($searchData)
        ->through([
            function ($query, $next) {
                return $next($query);
            },
        ])
        ->thenReturn()
        ->get();

    expect($results)->each->toBeInstanceOf(Tour::class)
        ->and($results->count())->toBe(3);
});
