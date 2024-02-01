<?php

namespace Database\Factories;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TravelFactory extends Factory
{
    protected $model = Travel::class;

    public function definition(): array
    {
        return [
            'slug' => fake()->slug(),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'numberOfDays' => fake()->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
