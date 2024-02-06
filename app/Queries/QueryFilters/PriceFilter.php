<?php

namespace App\Queries\QueryFilters;

use App\Data\Value\Price;
use App\Models\Tour;
use App\Queries\GiveMeTravels;
use Illuminate\Database\Eloquent\Builder;
use Spatie\LaravelData\Optional;

class PriceFilter extends AbstractFilter
{
    /**
     * @param  GiveMeTravels|Builder<Tour>  $query
     */
    public function perform(GiveMeTravels|Builder $query): void
    {
        if ($this->searchData) {

            $priceFromIsSet = $this->searchData->priceFrom && ! ($this->searchData->priceFrom instanceof Optional);
            $priceToIsSet = $this->searchData->priceTo && ! ($this->searchData->priceTo instanceof Optional);

            $query->when($priceFromIsSet, function ($q) {
                /**
                 * @phpstan-ignore-next-line
                 */
                $q->where('price', '>=', Price::from($this->searchData->priceFrom)->toCents());
            })
                ->when($priceToIsSet, function ($q) {
                    /**
                     * @phpstan-ignore-next-line
                     */
                    $q->where('price', '<=', Price::from($this->searchData->priceTo)->toCents());
                });
        }

    }
}
