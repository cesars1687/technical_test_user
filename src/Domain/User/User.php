<?php

namespace App\Domain\User;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\User\ValueObjects\UserId;
use App\Domain\User\ValueObjects\Name;
use App\Domain\User\ValueObjects\Email;
use App\Domain\User\ValueObjects\Password;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User
{
    #[ORM\Id, ORM\Column(type: 'string', length: 36)]
    #[ORM\GeneratedValue(strategy: "NONE")]
    private string $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', unique: true)]
    private string $email;

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    public function __construct(Name $name, Email $email, Password $password)
    {
        $this->id = (new UserId())->value();
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

}
