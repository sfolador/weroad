<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class MoodData extends Data
{
    public function __construct(
        public string $name,
        public int $value
    ) {
    }
}
