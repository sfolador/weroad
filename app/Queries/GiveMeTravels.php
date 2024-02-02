<?php

namespace App\Queries;

use App\Data\Search\SearchData;
use App\Models\Tour;
use App\Queries\Traits\HasPipeline;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Traits\ForwardsCalls;

/** @mixin Builder<Tour> */
class GiveMeTravels
{
    use ForwardsCalls,HasPipeline;

    /**
     * @var Builder<Tour>
     */
    private Builder $builder;

    private function __construct(public SearchData $searchData)
    {
        $this->builder = Tour::query()->with('travel');
    }

    public static function query(SearchData $searchData): self
    {
        return new self($searchData);
    }

    /**
     * @param  array<mixed,mixed>  $arguments
     */
    public function __call(string $name, array $arguments): mixed
    {
        return $this->forwardDecoratedCallTo(
            $this->builder,
            $name,
            $arguments,
        );
    }
}
