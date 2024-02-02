<?php

namespace App\Data\Search;

use App\Models\Enums\SortDirection;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;
use Ramsey\Collection\Sort;
use Spatie\LaravelData\Attributes\Validation\After;
use Spatie\LaravelData\Attributes\Validation\AfterOrEqual;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\GreaterThanOrEqualTo;
use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\InArray;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\References\FieldReference;

class SearchData extends Data
{
    public function __construct(
        #[StringType, Min(3), Max(128)]
        public Optional|string $slug,
        #[IntegerType, Min(0)]
        public Optional|int $priceFrom,
        #[IntegerType, Min(0), GreaterThanOrEqualTo('priceFrom')]
        public Optional|int $priceTo,
        #[WithCast(DateTimeInterfaceCast::class, type: Carbon::class),AfterOrEqual('today')]
        public Optional|Carbon $dateFrom,
        #[ Rule('after_or_equal:dateFrom')]
        public Optional|Carbon $dateTo,
        #[WithCast(EnumCast::class, type: SortDirection::class),Rule('in:asc,desc')]
        public SortDirection $sortDirection = SortDirection::ASC,
    ) {
    }
}
