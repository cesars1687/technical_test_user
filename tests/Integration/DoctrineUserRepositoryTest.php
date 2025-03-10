<?php

namespace Tests\Integration;

use App\Domain\User\User;
use App\Domain\User\ValueObjects\UserId;
use App\Domain\User\ValueObjects\Name;
use App\Domain\User\ValueObjects\Email;
use App\Domain\User\ValueObjects\Password;
use App\Infrastructure\Persistence\DoctrineUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class DoctrineUserRepositoryTest extends TestCase
{
    private DoctrineUserRepository $repository;
    private EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = require __DIR__ . '/../../bootstrap.php';
        $this->entityManager->beginTransaction();
        $this->repository = new DoctrineUserRepository($this->entityManager);
    }

    protected function tearDown(): void
    {
        $this->entityManager->rollback();
        parent::tearDown();
    }

    public function testCanSaveAndRetrieveUser()
    {
        $user = new User(
            new Name('Cesar Herbozo'),
            new Email('cesar@hotmail.com'),
            new Password('StrongPass123!')
        );

        $this->repository->save($user);
        $retrievedUser = $this->repository->findById(new UserId($user->id()));

        $this->assertNotNull($retrievedUser);
        $this->assertEquals('cesar@hotmail.com', $retrievedUser->email());
    }
}
