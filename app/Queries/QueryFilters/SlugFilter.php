<?php

namespace App\Queries\QueryFilters;

use App\Models\Tour;
use App\Queries\GiveMeTravels;
use Illuminate\Database\Eloquent\Builder;
use Spatie\LaravelData\Optional;

class SlugFilter extends AbstractFilter
{
    /**
     * @param GiveMeTravels|Builder<Tour> $query
     * @return void
     */
    public function perform(GiveMeTravels|Builder $query): void
    {
        if ($this->searchData) {
            $query->when( (!$this->searchData->slug instanceof Optional) && $this->searchData->slug, function ($q) {

                $q->whereHas('travel', function ($q) {
                    /**
                     * @phpstan-ignore-next-line
                     */
                    $q->where('slug', $this->searchData->slug);
                });
            });

        }

    }
}
