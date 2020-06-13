<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Illuminate\Support\Str;

$factory->define(User::class, function () {
    return [
        'name' => 'eldojr90',
        'email' => 'eldojr90@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('eli010612'),
        'remember_token' => Str::random(10),
    ];
});
