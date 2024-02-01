<?php

namespace Database\Factories;

use App\Models\Mood;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MoodFactory extends Factory
{
    protected $model = Mood::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function nature(): MoodFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'nature',
            ];
        });
    }

    public function relax(): MoodFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'relax',
            ];
        });

    }

    public function history(): MoodFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'history',
            ];
        });

    }

    public function culture(): MoodFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'culture',
            ];
        });

    }

    public function party(): MoodFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'party',
            ];
        });

    }
}
