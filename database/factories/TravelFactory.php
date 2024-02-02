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
            'public' => fake()->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function public(): self
    {
        return $this->state(fn (array $attributes) => [
            'public' => true,
        ]);
    }

    public function private(): self
    {
        return $this->state(fn (array $attributes) => [
            'public' => false,
        ]);
    }
}
