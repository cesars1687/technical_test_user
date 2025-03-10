<?php

namespace Tests\Unit\Application;

use App\Application\RegisterUserUseCase;
use App\Application\RegisterUserRequest;
use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\ValueObjects\Email;
use App\Domain\User\ValueObjects\Name;
use App\Domain\User\ValueObjects\Password;
use PHPUnit\Framework\TestCase;
use App\Domain\User\Exceptions\UserAlreadyExistsException;

class RegisterUserUseCaseTest extends TestCase
{
    private UserRepositoryInterface $repository;
    private RegisterUserUseCase $useCase;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(UserRepositoryInterface::class);
        $this->useCase = new RegisterUserUseCase($this->repository);
    }

    public function testUserRegistrationSuccess()
    {
        $this->repository->method('findByEmail')->willReturn(null);

        $request = new RegisterUserRequest('Cesar Herbozo', 'cesar@example.com', 'StrongPass123!');
        $user = $this->useCase->execute($request);

        $this->assertEquals('cesar@example.com', $user->email());
    }

    public function testUserAlreadyExistsThrowsException()
    {
        $this->repository->method('findByEmail')->willReturn(new User(
            new Name('Cesar Herbozo'),
            new Email('cesar@gmail.com'),
            new Password('StrongPass123!')
        ));

        $this->expectException(UserAlreadyExistsException::class);
        $request = new RegisterUserRequest('Cesar Herbozo', 'cesar@gmail.com', 'StrongPass123!');
        $this->useCase->execute($request);
    }
}
