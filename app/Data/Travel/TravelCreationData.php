<?php

namespace App\Data\Travel;

use App\Data\MoodData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class TravelCreationData extends Data
{
    public function __construct(
        public string $name,
        public string $description,
        public int $numberOfDays,
        #[DataCollectionOf(MoodData::class)]
        public DataCollection $moods,
    ) {
    }
}
