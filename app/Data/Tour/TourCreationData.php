<?php

namespace App\Data\Tour;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class TourCreationData extends Data
{
    public function __construct(
        #[StringType, Min(3), Max(128)]
        public string $name,
        #[Uuid,Exists('travels','id')]
        public string $travel,
        #[WithCast(DateTimeInterfaceCast::class, type: Carbon::class)]
        public Carbon $startingDate,
        #[WithCast(DateTimeInterfaceCast::class, type: Carbon::class)]
        public Carbon $endingDate,
        public int $price
    )
    {}
}
