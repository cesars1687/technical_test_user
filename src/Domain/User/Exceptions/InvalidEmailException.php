<?php
namespace App\Domain\User\Exceptions;

use DomainException;

class InvalidEmailException extends DomainException
{
    public function __construct()
    {
        parent::__construct("The email is not valid.");
    }
}
