<?php

namespace App\Data\Auth;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Data;
use Symfony\Contracts\Service\Attribute\Required;

class LoginData extends Data
{
    public function __construct(
        #[Email, Required]
        public string $email,
        #[Password, Required]
        public string $password
    ) {
    }
}
