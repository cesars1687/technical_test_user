<?php
namespace App\Domain\User\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

class UserId
{
    private string $id;

    public function __construct(?string $id = null)
    {
        if ($id === null) {
            $this->id = Uuid::uuid4()->toString();
        } else {
            if (!Uuid::isValid($id)) {
                throw new InvalidArgumentException("Invalid UUID format");
            }
            $this->id = $id;
        }
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function value(): string {
        return $this->id;
    }
}
