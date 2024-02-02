<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

class MoodData extends Data
{
    public function __construct(
        #[StringType, Min(3), Max(128)]
        public string $name,
        #[IntegerType, Min(0), Max(100)]
        public int $value
    ) {
    }
}
