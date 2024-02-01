<?php

use App\Models\Mood;

it('has a uuid', function () {
    $mood = Mood::factory()->create();
    expect($mood->id)->toBeUuid();
});

it('has a name', function () {

    $mood = Mood::factory()->create();
    expect($mood->name)->toBeString();
});
