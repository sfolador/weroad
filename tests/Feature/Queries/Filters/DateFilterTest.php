<?php

use App\Data\Search\SearchData;
use App\Models\Tour;
use App\Models\Travel;
use App\Queries\GiveMeTravels;
use App\Queries\QueryFilters\DateFilter;

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
        'startingDate' => now()->addMonth(),
        'endingDate' => now()->addMonth()->addDays(5),
    ]);
    Tour::factory()->create([
        'travel_id' => $this->travel_two->id,
        'startingDate' => now()->subMonth(),
        'endingDate' => now()->subMonth()->subDays(5),
    ]);
    Tour::factory()->create([
        'travel_id' => $this->travel_three->id,
        'startingDate' => now()->subMonths(2),
        'endingDate' => now()->subMonths(2)->subDays(5),
    ]);
});
it('can be applied as a tappable scope', function () {

    $searchData = SearchData::from([
        'dateFrom' => now()->addMonth()->format('d-m-Y'),
    ]);

    $results = GiveMeTravels::query($searchData)
        ->tap(new DateFilter($searchData))
        ->get();

    expect($results->count())->toBe(1);
});

it('can be used in a pipeline', function () {

    $searchData = SearchData::from([
        'dateFrom' => now()->addMonth()->format('d-m-Y'),
    ]);

    $results = GiveMeTravels::query($searchData)
        ->through([
            DateFilter::class,
        ])
        ->thenReturn()
        ->get();

    expect($results->count())->toBe(1);
});

it('can have a start', function () {
    $searchData = SearchData::from([
        'dateFrom' => now()->addMonth()->format('d-m-Y'),
    ]);

    $results = GiveMeTravels::query($searchData)
        ->through([
            DateFilter::class,
        ])
        ->thenReturn()
        ->get();

    expect($results->count())->toBe(1);
});

it('can have an end', function () {
    $searchData = SearchData::from([
        'dateTo' => now()->subMonth()->format('d-m-Y'),
    ]);

    $results = GiveMeTravels::query($searchData)
        ->through([
            DateFilter::class,
        ])
        ->thenReturn()
        ->get();

    expect($results->count())->toBe(2);
});

it('can have a start and an end', function () {
    $searchData = SearchData::from([
        'dateFrom' => now()->subMonths(2)->format('d-m-Y'),
        'dateTo' => now()->addMonth()->format('d-m-Y'),
    ]);

    $results = GiveMeTravels::query($searchData)
        ->through([
            DateFilter::class,
        ])
        ->thenReturn()
        ->get();

    expect($results->count())->toBe(3);
});
