<?php

namespace App\Queries;

use App\Data\Search\SearchData;
use App\Models\Travel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Traits\ForwardsCalls;

/** @mixin Builder */
class GiveMeTravels
{
    use ForwardsCalls;

    private Builder $builder;

    private function __construct(public SearchData $searchData)
    {
        $this->builder = Travel::query();
    }

    public static function query(SearchData $searchData): self
    {
        return new self($searchData);
    }

    public function __call(string $name, array $arguments): mixed
    {
        return $this->forwardDecoratedCallTo(
            $this->builder,
            $name,
            $arguments,
        );
    }
}
