<?php

namespace App\Queries\QueryFilters;

use App\Data\Search\SearchData;
use App\Models\Tour;
use App\Queries\GiveMeTravels;
use Closure;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter
{
    public function __construct(public ?SearchData $searchData = null)
    {
    }

    public function handle(GiveMeTravels $query, Closure $next): mixed
    {
        $this->searchData = $query->searchData;
        $this->perform($query);

        return $next($query);
    }

    /**
     * @param  GiveMeTravels|Builder<Tour>  $query
     */
    public function __invoke(GiveMeTravels|Builder $query): void
    {
        $this->perform($query);
    }

    /**
     * @param  GiveMeTravels|Builder<Tour>  $query
     */
    abstract public function perform(GiveMeTravels|Builder $query): void;
}
