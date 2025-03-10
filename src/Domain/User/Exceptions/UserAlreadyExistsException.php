<?php
namespace App\Domain\User\Exceptions;

use DomainException;

class UserAlreadyExistsException extends DomainException
{
    public function __construct()
    {
        parent::__construct("The email is already in use.", 400);
    }
}
