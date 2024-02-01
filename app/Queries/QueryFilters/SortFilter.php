<?php

namespace App\Queries\QueryFilters;

use App\Queries\GiveMeTravels;
use Closure;

class SortFilter
{
    public function __construct()
    {
    }

    public function handle(GiveMeTravels $query, Closure $next): mixed
    {
        $query->where('slug');

        return $next($query);
    }
}
