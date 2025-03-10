<?php
namespace App\Domain\User\Exceptions;

use DomainException;

class WeakPasswordException extends DomainException
{
    public function __construct()
    {
        parent::__construct("The password does not meet security requirements.");
    }
}
