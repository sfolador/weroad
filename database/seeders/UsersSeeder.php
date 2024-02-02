<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::create([
            'email' => 'admin@example.com',
            'password' => bcrypt('admin_password'),
        ]);

        $adminUser->role()->associate(Role::admin());
        $adminUser->save();

        $editorUser = User::create([
            'email' => 'editor@example.com',
            'password' => bcrypt('editor_password'),
        ]);

        $editorUser->role()->associate(Role::editor());
        $editorUser->save();
    }
}
