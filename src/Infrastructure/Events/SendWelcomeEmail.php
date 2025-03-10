<?php
namespace App\Infrastructure\Events;

use App\Domain\User\Events\UserRegisteredEvent;

class SendWelcomeEmail
{
    public function handle(UserRegisteredEvent $event): void
    {
        $user = $event->getUser();
        $email = $user->email();

        // Simular envío de email
        echo "Sending welcome email to {$email}\n";
    }
}
