<?php

use App\Data\Search\SearchData;
use App\Models\Tour;
use App\Models\Travel;
use App\Queries\GiveMeTravels;
use App\Queries\QueryFilters\SlugFilter;

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
it('can be applied as a tappable scope', function () {

    $searchData = SearchData::from([
        'slug' => $this->travel->slug,
    ]);

    $results = GiveMeTravels::query($searchData)
        ->tap(new SlugFilter($searchData))
        ->get();

    expect($results->count())->toBe(1)
        ->and($results->first()->travel->slug)->toBe($this->travel->slug);
});

it('can be used in a pipeline', function () {

    $searchData = SearchData::from([
        'slug' => $this->travel->slug,
    ]);

    $results = GiveMeTravels::query($searchData)
        ->through([
            SlugFilter::class,
        ])
        ->thenReturn()
        ->get();

    expect($results->count())->toBe(1)
        ->and($results->first()->travel->slug)->toBe($this->travel->slug);
});
