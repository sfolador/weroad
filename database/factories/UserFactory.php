<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'role_id' => Role::factory()->create()->id,
        ];
    }

    public function admin(): Factory|UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::admin()->id,
            ];
        });
    }

    public function editor(): Factory|UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::editor()->id,
            ];
        });
    }
}
