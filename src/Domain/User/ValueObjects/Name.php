<?php
namespace App\Domain\User\ValueObjects;

use InvalidArgumentException;

class Name
{
    private string $value;

    public function __construct(string $value)
    {
        if (strlen($value) < 3 || !preg_match('/^[A-Za-z ]+$/', $value)) {
            throw new InvalidArgumentException("Invalid name format");
        }
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function value(): string { return $this->value; }
}
