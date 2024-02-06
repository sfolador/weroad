<?php

use App\Models\Tour;
use App\Models\User;

it('everybody can view any', function () {
    $user = User::factory()->create();
    $this->assertTrue($user->can('viewAny', Tour::class));
});

it('everybody can view', function () {
    $user = User::factory()->create();
    $tour = Tour::factory()->create();
    $this->assertTrue($user->can('view', $tour));
});

it('only admin can create', function () {
    $user = User::factory()->admin()->create();
    $this->assertTrue($user->can('create', Tour::class));
});

it('only admin can update', function () {
    $user = User::factory()->admin()->create();
    $tour = Tour::factory()->create();
    $this->assertTrue($user->can('update', $tour));
});

it('only admin can delete', function () {
    $user = User::factory()->admin()->create();
    $tour = Tour::factory()->create();
    $this->assertTrue($user->can('delete', $tour));
});

it('only admin can restore', function () {
    $user = User::factory()->admin()->create();
    $tour = Tour::factory()->create();
    $this->assertTrue($user->can('restore', $tour));
});

it('only admin can force delete', function () {
    $user = User::factory()->admin()->create();
    $tour = Tour::factory()->create();

    $this->assertTrue($user->can('forceDelete', $tour));
});

it('a user without role cannot do anything except view',function(){
    $user = User::factory()->create([
        'role_id' => null
    ]);
    $tour = Tour::factory()->create();
    $this->assertFalse($user->can('create', Tour::class));
    $this->assertFalse($user->can('update', $tour));
    $this->assertFalse($user->can('delete', $tour));
    $this->assertFalse($user->can('restore', $tour));
    $this->assertFalse($user->can('forceDelete', $tour));
});
