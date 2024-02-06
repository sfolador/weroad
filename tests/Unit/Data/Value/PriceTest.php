<?php

use App\Data\Value\Price;

it('creates a price', function () {
    $price = new Price(0.4);
    expect($price->value)->toBe(0.4);
});

it('creates a price from a value', function () {
    $price = Price::from(0.4);
    expect($price->value)->toBe(0.4);
});

it('converts a price to cents', function () {
    $price = Price::from(0.4);
    expect($price->toCents())->toBe(40);
});

it('converts a price from cents', function () {
    $price = Price::from(40);
    expect($price->fromCents())->toBe(0.4);
});
