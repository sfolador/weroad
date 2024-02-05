<?php

use App\Actions\Search\SearchTours;
use App\Data\Search\SearchData;
use App\Models\Enums\SortDirection;
use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Pagination\LengthAwarePaginator;

beforeEach(function(){

    $this->travel = Travel::factory()->public()->create();

    $this->startingDate = now()->subDays(2);
    $this->endingDate = now()->subDay();

    $this->tour = Tour::factory()->create([
        'travel_id' => $this->travel->id,
        'startingDate' =>  $this->startingDate,
        'endingDate' => $this->endingDate,
        'price' => 10000
    ]);

    $this->tourTwo = Tour::factory()->create([
        'travel_id' => $this->travel->id,
        'startingDate' =>  $this->startingDate,
        'endingDate' => $this->endingDate,
        'price' => 500
    ]);


    $this->tourThree = Tour::factory()->create([
        'travel_id' => $this->travel->id,
        'startingDate' =>  $this->startingDate,
        'endingDate' => $this->endingDate,
        'price' => 100
    ]);

});

it('searches tours',function(){

    $travels = SearchTours::execute(SearchData::from([
        'priceFrom' => 100
    ]));

    expect($travels)->toBeInstanceOf(LengthAwarePaginator::class);
});


it ('can search by price',function(){


    $travels = SearchTours::execute(SearchData::from([
        'priceFrom' => 20000
    ]));

    expect($travels)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($travels->items())->toHaveCount(0);


    $travels = SearchTours::execute(SearchData::from([
        'priceTo' => 400
    ]));

    expect($travels)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($travels->items())->toHaveCount(1);


    $travels = SearchTours::execute(SearchData::from([
        'priceFrom' => 50,
        'priceTo' => 1000
    ]));

    expect($travels)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($travels->items())->toHaveCount(2);
});


it('can show only public travels',function(){

    $travel = Travel::factory()->private()->create();
    $travels = SearchTours::execute(SearchData::from([]));

    expect($travels)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($travels->items())->toHaveCount(3);

});




it('filters the slug',function(){

    $otherTravel = Travel::factory()->create([
        'slug' => 'other_slug'
    ]);

    $otherTour = Tour::factory()->create([
        'travel_id' => $otherTravel->id,
        'startingDate' =>  $this->startingDate,
        'endingDate' => $this->endingDate,
        'price' => 100
    ]);

    $travels = SearchTours::execute(SearchData::from([
        'slug' => $this->travel->slug
    ]));

    expect($travels)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($travels->items())->toHaveCount(3);

});

it('filters the starting date',function(){

    $travels = SearchTours::execute(SearchData::from([
        'startingDate' => $this->startingDate->format('Y-m-d')
    ]));

    expect($travels)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($travels->items())->toHaveCount(3);

});


it('filters the ending date',function(){

    $travels = SearchTours::execute(SearchData::from([
        'startingDate' => $this->endingDate->format('Y-m-d')
    ]));

    expect($travels)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($travels->items())->toHaveCount(3);

});

it('filters the starting and ending date',function(){

    $travels = SearchTours::execute(SearchData::from([
        'startingDate' => $this->startingDate->format('Y-m-d'),
        'endingDate' => $this->endingDate->format('Y-m-d')
    ]));

    expect($travels)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($travels->items())->toHaveCount(3);

});

it('filters the starting and ending date and price',function(){

    $travels = SearchTours::execute(SearchData::from([
        'startingDate' => $this->startingDate->format('Y-m-d'),
        'endingDate' => $this->endingDate->format('Y-m-d'),
        'priceFrom' => 50,
        'priceTo' => 1000
    ]));

    expect($travels)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($travels->items())->toHaveCount(2);

});


it('filters the starting and ending date and price and slug',function(){

    $travels = SearchTours::execute(SearchData::from([
        'startingDate' => $this->startingDate->format('Y-m-d'),
        'endingDate' => $this->endingDate->format('Y-m-d'),
        'priceFrom' => 50,
        'priceTo' => 1000,
        'slug' => $this->travel->slug
    ]));

    expect($travels)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($travels->items())->toHaveCount(2);

});


it('can sort everything in asc by price',function(){
    $travels = SearchTours::execute(SearchData::from([]));

    expect($travels)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($travels->items())->toHaveCount(3)
        ->and($travels->items()[0]->price)->toBe(100)
        ->and($travels->items()[1]->price)->toBe(500)
        ->and($travels->items()[2]->price)->toBe(10000);
});

it('can sort everything in desc by price',function(){
    $travels = SearchTours::execute(SearchData::from([
        'sortDirection' => SortDirection::DESC
    ]));

    expect($travels)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($travels->items())->toHaveCount(3)
        ->and($travels->items()[0]->price)->toBe(10000)
        ->and($travels->items()[1]->price)->toBe(500)
        ->and($travels->items()[2]->price)->toBe(100);
});
