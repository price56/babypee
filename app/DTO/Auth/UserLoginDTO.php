<?php

namespace App\DTO\Auth;

class UserLoginDTO
{
    public function __construct(
        private readonly string $password,
        private readonly null|string $email = null,
        private readonly null|string $mobile = null,
    )
    {
    }

    public function authId(): array
    {
        $data = [];

        if($this->email) {
            $data['email'] = $this->email;
        }

        if($this->mobile) {
            $data['mobile'] = $this->mobile;
        }

        return $data;
    }

    public function password(): string
    {
        return $this->password;
    }
}
