<?php
namespace App\Domain\User\ValueObjects;

use App\Domain\User\Exceptions\WeakPasswordException;

class Password
{
    private string $hash;

    public function __construct(string $password)
    {
        if (!preg_match('/^(?=.*[A-Z])(?=.*\\d)(?=.*[!@#$%^&*])[A-Za-z\\d!@#$%^&*]{8,}$/', $password)) {
            throw new WeakPasswordException();
        }
        $this->hash = password_hash($password, PASSWORD_BCRYPT);
    }

    public function __toString(): string
    {
        return $this->hash;
    }

    public function hash(): string { return $this->hash; }
}
