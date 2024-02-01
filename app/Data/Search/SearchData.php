<?php

namespace App\Data\Search;

use App\Models\Enums\SortDirection;
use Ramsey\Collection\Sort;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\GreaterThanOrEqualTo;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

/**
 * A public (no auth) endpoint to get a list of paginated tours by the travel `slug`
 * (e.g. all the tours of the travel `foo-bar`). Users can filter (search) the results by `priceFrom`, `priceTo`, `dateFrom` (from that `startingDate`) and `dateTo` (until that `startingDate`).
 * User can sort the list by `price` asc and desc.
 * They will **always** be sorted, after every additional user-provided filter, by `startingDate` asc.
 */
class SearchData extends Data
{
    public function __construct(
        #[StringType, Min(3)]
        public string $slug,
        #[IntegerType, Min(0)]
        public ?int $priceFrom,
        #[IntegerType, Min(0), GreaterThanOrEqualTo('priceFrom')]
        public ?int $priceTo,
        #[Date, WithCast(DateTimeInterfaceCast::class)]
        public ?string $dateFrom,
        #[Date, WithCast(DateTimeInterfaceCast::class)]
        public ?string $dateTo,
        #[WithCast(EnumCast::class, type: SortDirection::class)]
        public ?SortDirection $sortDirection,
    ) {
    }
}
