<?php
namespace App\Application;

use App\Domain\User\Exceptions\UserAlreadyExistsException;
use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\ValueObjects\Name;
use App\Domain\User\ValueObjects\Email;
use App\Domain\User\ValueObjects\Password;
use App\Domain\User\Events\UserRegisteredEvent;
use App\Infrastructure\Events\EventDispatcher;

class RegisterUserUseCase
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param RegisterUserRequest $request
     * @return User
     */
    public function execute(RegisterUserRequest $request): User
    {

        $existingUser = $this->repository->findByEmail(new Email($request->email()));
        if ($existingUser !== null) {
            throw new UserAlreadyExistsException();
        }

        $user = new User(
            new Name($request->name()),
            new Email($request->email()),
            new Password($request->password())
        );

        $this->repository->save($user);

        //Send email after save
        EventDispatcher::dispatch(new UserRegisteredEvent($user));
        return $user;
    }
}
