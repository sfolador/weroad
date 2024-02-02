<?php

use App\Data\Search\SearchData;
use App\Models\Tour;
use App\Models\Travel;
use App\Queries\GiveMeTravels;
use App\Queries\QueryFilters\PriceFilter;

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
        'price' => 100,
    ]);
    Tour::factory()->create([
        'travel_id' => $this->travel_two->id,
        'price' => 150,
    ]);
    Tour::factory()->create([
        'travel_id' => $this->travel_three->id,
        'price' => 50,
    ]);
});
it('can be applied as a tappable scope', function () {

    $searchData = SearchData::from([
        'priceFrom' => 100,
        'priceTo' => 200,
    ]);

    $results = GiveMeTravels::query($searchData)
        ->tap(new PriceFilter($searchData))
        ->get();

    expect($results->count())->toBe(2);
});

it('can be used in a pipeline', function () {

    $searchData = SearchData::from([
        'priceFrom' => 100,
        'priceTo' => 200,
    ]);

    $results = GiveMeTravels::query($searchData)
        ->through([
            PriceFilter::class,
        ])
        ->thenReturn()
        ->get();

    expect($results->count())->toBe(2);
});
