<?php

namespace Tests\Unit\Domain;

use App\Domain\User\User;
use App\Domain\User\ValueObjects\UserId;
use App\Domain\User\ValueObjects\Name;
use App\Domain\User\ValueObjects\Email;
use App\Domain\User\ValueObjects\Password;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCanCreateUser()
    {
        $user = new User(
            new Name('Cesar Herbozo'),
            new Email('cesar@gmail.com'),
            new Password('StrongPass123!')
        );

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('Cesar Herbozo', $user->name());
        $this->assertEquals('cesar@gmail.com', $user->email());
    }
}
