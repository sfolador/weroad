<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Tour */
class TourResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'startingDate' => $this->startingDate->format('Y-m-d'),
            'endingDate' => $this->endingDate->format('Y-m-d'),
            /**
             * @phpstan-ignore-next-line
             */
            'price' => $this->price,
            'travel_id' => $this->travel_id,

        ];
    }
}
