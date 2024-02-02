<?php

namespace App\Data\Travel;

use App\Data\MoodData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class TravelCreationData extends Data
{
    /**
     * @param  string  $name
     * @param  string  $description
     * @param  int  $numberOfDays
     * @param  DataCollection<int,MoodData>  $moods
     */
    public function __construct(
        #[StringType, Min(3), Max(128)]
        public string $name,
        #[StringType, Min(3), Max(1000)]
        public string $description,
        #[IntegerType, Min(1), Max(365)]
        public int $numberOfDays,
        #[DataCollectionOf(MoodData::class)]
        public DataCollection $moods,
    ) {
    }
}
