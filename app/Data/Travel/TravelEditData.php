<?php

namespace App\Data\Travel;

use App\Data\MoodData;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\References\RouteParameterReference;

class TravelEditData extends Data
{
    public function __construct(
        #[Unique('travels', ignore: new RouteParameterReference('uuid'))]
        public string $uuid,
        public ?string $name,
        public ?string $description,
        public ?int $numberOfDays,
        public ?MoodData $moods,
    ) {
    }
}
