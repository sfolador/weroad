<?php

use App\Models\Enums\Roles;
use App\Models\Role;

it('has a uuid', function () {
    $role = Role::factory()->create();
    expect($role->id)->toBeUuid();
});

it('has a name', function () {

    $role = Role::factory()->create();
    expect($role->name)->toBe(Roles::ADMIN);
});

it('can be an admin role', function () {

    $role = Role::factory()->admin()->create();
    expect($role->name)->toBe(Roles::ADMIN);
});

it('can be an editor role', function () {

    $role = Role::factory()->editor()->create();
    expect($role->name)->toBe(Roles::EDITOR);
});
