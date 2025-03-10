<?php

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\User\Exceptions\InvalidEmailException;
use App\Domain\User\ValueObjects\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testValidEmail()
    {
        $email = new Email('test@example.com');
        $this->assertEquals('test@example.com', $email->value());
    }

    public function testInvalidEmailThrowsException()
    {
        $this->expectException(InvalidEmailException::class);
        new Email('invalid-email');
    }
}
