<?php

use App\Data\Search\SearchData;
use App\Models\Enums\SortDirection;
use Illuminate\Validation\ValidationException;

it('can have a slug', function () {
    $searchData = SearchData::from([
        'slug' => 'test',
    ]);
    expect($searchData->slug)->toBe('test');
});

it('can have a starting price', function () {
    $priceFrom = 100;
    $searchData = SearchData::from([
        'priceFrom' => $priceFrom,
    ]);
    expect($searchData->priceFrom)->toBe($priceFrom);
});

it('can have a stop price', function () {
    $priceTo = 100;
    $searchData = SearchData::from([
        'priceTo' => $priceTo,
    ]);
    expect($searchData->priceTo)->toBe($priceTo);
});

it('can have a starting date', function () {
    $dateFrom = '2021-01-01';
    $searchData = SearchData::from([
        'dateFrom' => $dateFrom,
    ]);
    expect($searchData->dateFrom->format('Y-m-d'))->toBe($dateFrom);
});

it('can have a stop date', function () {
    $dateTo = '2021-01-01';
    $searchData = SearchData::from([
        'dateTo' => $dateTo,
    ]);
    expect($searchData->dateTo->format('Y-m-d'))->toBe($dateTo);
});

it('can have a sort direction', function () {
    $searchData = SearchData::from([
        'sortDirection' => 'desc',
    ]);
    expect($searchData->sortDirection)->toBe(SortDirection::DESC);
});

it('the slug must be at least 3 characters long', function () {
    SearchData::validate([
        'slug' => 'te',
    ]);
})->throws(ValidationException::class, 'The slug field must be at least 3 characters.');

it('the slug must be maximum 128 characters long', function () {
    SearchData::validate([
        'slug' => Str::random(200),
    ]);
})->throws(ValidationException::class, 'The slug field must not be greater than 128 characters.');

it('the price from must be at least 0', function () {
    SearchData::validate([
        'priceFrom' => -1,
    ]);
})->throws(ValidationException::class, 'The price from field must be at least 0.');

it('the price to must be at least 0', function () {
    SearchData::validate([
        'priceTo' => -1,
    ]);
})->throws(ValidationException::class, 'The price to field must be at least 0.');

it('the price to must be greater than price from', function () {
    $priceFrom = 100;
    try {
        SearchData::validate([
            'priceFrom' => $priceFrom,
            'priceTo' => 20,
        ]);
    } catch (ValidationException $exception) {
        expect($exception->validator->errors()->first('priceTo'))->toBe("The price to field must be greater than or equal to $priceFrom.");
    }
});

it('the date from must be after or equal to today', function () {
    $dateFrom = now()->subDay();
    SearchData::validate([
        'dateFrom' => $dateFrom,
    ]);
})->throws(ValidationException::class, 'The date from field must be a date after or equal to today.');

it('the date from must be a date', function () {

    SearchData::from([
        'dateFrom' => 'a string',
    ]);

})->throws(Spatie\LaravelData\Exceptions\CannotCastDate::class);

it('the date to must be a date', function () {

    SearchData::from([
        'dateTo' => 'a string',
    ]);

})->throws(Spatie\LaravelData\Exceptions\CannotCastDate::class);

it('the date to must greater than the date from', function () {

    SearchData::validate([
        'dateFrom' => now()->addDay()->format('d-m-Y'),
        'dateTo' => now()->subDays(2)->format('d-m-Y'),
    ]);

})->throws(ValidationException::class, 'The date to field must be a date after or equal to date from.');

it('validates the sort direction', function () {
    SearchData::validate([
        'sortDirection' => 'invalid',
    ]);
})->throws(ValidationException::class, 'The selected sort direction is invalid.');
