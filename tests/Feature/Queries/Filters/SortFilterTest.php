<?php

use App\Data\Search\SearchData;
use App\Models\Enums\SortDirection;
use App\Models\Tour;
use App\Models\Travel;
use App\Queries\GiveMeTravels;
use App\Queries\QueryFilters\PriceFilter;
use App\Queries\QueryFilters\SlugFilter;
use App\Queries\QueryFilters\SortFilter;


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

    $this->tour = Tour::factory()->create([
        'travel_id' => $this->travel->id,
        'price' => 100,
    ]);
    $this->tour_two = Tour::factory()->create([
        'travel_id' => $this->travel_two->id,
        'price' => 150,
    ]);
    $this->tour_three = Tour::factory()->create([
        'travel_id' => $this->travel_three->id,
        'price' => 50,
    ]);
});
it('can be applied as a tappable scope', function () {

    $searchData = SearchData::from([]);

    $results = GiveMeTravels::query($searchData)
        ->tap(new SortFilter($searchData))
        ->get();


    expect($results->count())->toBe(3)
    ->and($results->first()->travel->slug)->toBe($this->travel_three->slug);
});

it('can be used in a pipeline', function () {

    $searchData = SearchData::from([]);

    $results = GiveMeTravels::query($searchData)
        ->through([
            SortFilter::class,
        ])
        ->thenReturn()
        ->get();

    expect($results->count())->toBe(3)
        ->and($results->first()->travel->slug)->toBe($this->travel_three->slug);
});


it('can use a desc direction',function(){
    $searchData = SearchData::from([
        'sortDirection' => SortDirection::DESC
    ]);

    $results = GiveMeTravels::query($searchData)
        ->through([
            SortFilter::class,
        ])
        ->thenReturn()
        ->get();


    expect($results->count())->toBe(3)
        ->and($results->first()->price)->toBe($this->tour_two->price);
});


it('can use a asc direction',function(){
    $searchData = SearchData::from([
        'sortDirection' => SortDirection::ASC
    ]);

    $results = GiveMeTravels::query($searchData)
        ->through([
            SortFilter::class,
        ])
        ->thenReturn()
        ->get();


    expect($results->count())->toBe(3)
        ->and($results->first()->price)->toBe($this->tour_three->price);
});
