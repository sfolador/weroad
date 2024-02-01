<?php

namespace App\Queries\QueryFilters;

use App\Queries\GiveMeTravels;
use Closure;

class SlugFilter
{
    public function __construct()
    {
    }

    public function handle(GiveMeTravels $query, Closure $next): mixed
    {
        $query->where('slug', $query->searchData->slug);

        return $next($query);
    }
}
