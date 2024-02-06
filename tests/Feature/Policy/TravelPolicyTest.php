<?php

use App\Models\Travel;
use App\Models\User;

it('admin can view any', function () {
    $user = User::factory()->admin()->create();
    $this->assertTrue($user->can('viewAny', Travel::class));
});

it('editor cannot view any', function () {
    $user = User::factory()->editor()->create();
    $this->assertFalse($user->can('viewAny', Travel::class));
});

it('admin can view', function () {
    $user = User::factory()->admin()->create();
    $travel = Travel::factory()->create(['public' => false]);
    $this->assertTrue($user->can('view', $travel));
});

it('editor cannot view', function () {
    $user = User::factory()->editor()->create();
    $travel = Travel::factory()->create(['public' => false]);
    $this->assertFalse($user->can('view', $travel));
});

it('admin can create', function () {
    $user = User::factory()->admin()->create();
    $this->assertTrue($user->can('create', Travel::class));
});

it('editor cannot create', function () {
    $user = User::factory()->editor()->create();
    $this->assertFalse($user->can('create', Travel::class));
});

it('editor can update', function () {
    $user = User::factory()->editor()->create();
    $travel = Travel::factory()->create();
    $this->assertTrue($user->can('update', $travel));
});

it('admin cannot update', function () {
    $user = User::factory()->admin()->create();
    $travel = Travel::factory()->create();
    $this->assertFalse($user->can('update', $travel));
});

it('admin can delete', function () {
    $user = User::factory()->admin()->create();
    $travel = Travel::factory()->create();
    $this->assertTrue($user->can('delete', $travel));
});

it('editor cannot delete', function () {
    $user = User::factory()->editor()->create();
    $travel = Travel::factory()->create();
    $this->assertFalse($user->can('delete', $travel));
});

it('admin can restore', function () {
    $user = User::factory()->admin()->create();
    $travel = Travel::factory()->create();
    $this->assertTrue($user->can('restore', $travel));
});

it('editor cannot restore', function () {
    $user = User::factory()->editor()->create();
    $travel = Travel::factory()->create();
    $this->assertFalse($user->can('restore', $travel));
});

it('admin can force delete', function () {
    $user = User::factory()->admin()->create();
    $travel = Travel::factory()->create();
    $this->assertTrue($user->can('forceDelete', $travel));
});

it('editor cannot force delete', function () {
    $user = User::factory()->editor()->create();
    $travel = Travel::factory()->create();
    $this->assertFalse($user->can('forceDelete', $travel));
});
