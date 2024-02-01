<?php

namespace App\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class TravelCreationData extends Data
{
    public function __construct(
        public string $name,
        public string $description,
        public int $numberOfDays,
        public Collection $moods,

    ) {
    }
}
