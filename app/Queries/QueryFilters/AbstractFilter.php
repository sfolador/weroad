<?php

namespace App\Queries\QueryFilters;

use App\Data\Search\SearchData;
use App\Queries\GiveMeTravels;
use Closure;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter
{
    public function __construct(public ?SearchData $searchData = null)
    {
    }

    public function handle(mixed $query, Closure $next): mixed
    {
        $this->searchData = $query->searchData;
        $this->perform($query);

        return $next($query);
    }

    public function __invoke(mixed $query): void
    {
        $this->perform($query);
    }

    abstract public function perform(GiveMeTravels|Builder $query): void;
}
