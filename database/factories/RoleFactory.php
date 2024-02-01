<?php

namespace Database\Factories;

use App\Models\Enums\Roles;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name' => Roles::ADMIN->value,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function admin(): RoleFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => Roles::ADMIN,  //@todo use an enum for this
            ];
        });
    }

    public function editor(): RoleFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => Roles::EDITOR,   //@todo use an enum for this
            ];
        });
    }
}
