<?php

namespace Database\Factories;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TourFactory extends Factory
{
    protected $model = Tour::class;

    public function definition(): array
    {
        return [
            'travel_id' => fake()->uuid(),
            'name' => fake()->name(),
            'startingDate' => Carbon::now(),
            'endingDate' => Carbon::now(),
            'price' => fake()->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
