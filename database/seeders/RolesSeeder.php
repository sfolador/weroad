<?php

namespace Database\Seeders;

use App\Models\Enums\Roles;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::create([
            'name' => Roles::ADMIN,
        ]);

        $editorRole = Role::create([
            'name' => Roles::EDITOR,
        ]);
    }
}
