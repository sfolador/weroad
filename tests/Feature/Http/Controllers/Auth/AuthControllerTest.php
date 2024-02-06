<?php

use App\Models\User;

it('can login user', function () {

    $admin = User::where('email', 'admin@example.com')->first();
    $password = 'admin_password';

    $response = $this->postJson(route('auth.login'), [
        'email' => $admin->email,
        'password' => $password,
    ]);

    $response->assertStatus(200);
});

it('a login gets a token', function () {

    $admin = User::where('email', 'admin@example.com')->first();
    $password = 'admin_password';

    $response = $this->postJson(route('auth.login'), [
        'email' => $admin->email,
        'password' => $password,
    ]);

    expect($response->json('access_token'))->toBeString();
});

it('a login with invalid credentials fails', function () {

    $admin = 'example@wrong.com';

    $password = 'wrong_password';

    $response = $this->postJson(route('auth.login'), [
        'email' => $admin,
        'password' => $password,
    ]);

    $response->assertStatus(401);

});

it('a login with wrong email fails', function () {

    $admin = 'example';

    $password = 'wrong_password';

    $response = $this->postJson(route('auth.login'), [
        'email' => $admin,
        'password' => $password,
    ]);

    $response->assertStatus(422);

});

it('a login with no password fails', function () {

    $admin = 'example';

    $password = '';

    $response = $this->postJson(route('auth.login'), [
        'email' => $admin,
        'password' => $password,
    ]);

    $response->assertStatus(422);

});
