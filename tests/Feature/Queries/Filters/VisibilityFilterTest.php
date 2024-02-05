<?php

use App\Data\Search\SearchData;
use App\Models\Tour;
use App\Models\Travel;
use App\Queries\GiveMeTravels;
use App\Queries\QueryFilters\SlugFilter;
use App\Queries\QueryFilters\VisibilityFilter;

beforeEach(function () {
    $this->travel = Travel::factory()->private()->create([
        'slug' => 'slug',
    ]);
    $this->travel_two = Travel::factory()->public()->create([
        'slug' => 'slug_2',
    ]);
    $this->travel_three = Travel::factory()->public()->create([
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
it('can be applied as a tappable scope', function () {

    $searchData = SearchData::from([]);

    $results = GiveMeTravels::query($searchData)
        ->tap(new VisibilityFilter($searchData))
        ->get();

    expect($results->count())->toBe(2);
});

it('can be used in a pipeline', function () {

    $searchData = SearchData::from([ ]);

    $results = GiveMeTravels::query($searchData)
        ->through([
            VisibilityFilter::class,
        ])
        ->thenReturn()
        ->get();

    expect($results->count())->toBe(2);
});
