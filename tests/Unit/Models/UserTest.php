<?php

use App\Models\User;

it('has an email', function () {
    $user = User::factory()->create();
    expect($user->email)->toBeString();
});

it('has a password', function () {
    $user = User::factory()->create();
    expect($user->password)->toBeString();
});
