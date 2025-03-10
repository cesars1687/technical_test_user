<?php
namespace App\Domain\User\ValueObjects;

use App\Domain\User\Exceptions\InvalidEmailException;

class Email
{
    private string $value;

    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function value(): string { return $this->value; }
}
