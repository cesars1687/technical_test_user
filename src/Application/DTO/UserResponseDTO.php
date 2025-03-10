<?php

namespace App\Application\DTO;

use App\Domain\User\User;

class UserResponseDTO
{
    private string $id;
    private string $name;
    private string $email;
    private string $createdAt;

    public function __construct(User $user)
    {
        $this->id = $user->id();
        $this->name = $user->name();
        $this->email = $user->email();
        $this->createdAt = $user->createdAt()->format('d-m-Y H:i:s');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->createdAt,
        ];
    }
}
