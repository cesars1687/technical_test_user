<?php
namespace App\Infrastructure\Http;

use App\Application\RegisterUserUseCase;
use App\Application\RegisterUserRequest;
use App\Infrastructure\Persistence\DoctrineUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Application\DTO\UserResponseDTO;

class UserController
{
    private RegisterUserUseCase $useCase;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $repository = new DoctrineUserRepository($entityManager);
        $this->useCase = new RegisterUserUseCase($repository);
    }

    public function registerUser(): void
    {

        $inputData = json_decode(file_get_contents("php://input"), true);

        try {
            if (!isset($inputData['name'], $inputData['email'], $inputData['password'])) {
                throw new \InvalidArgumentException("Missing required fields.");
            }

            $request = new RegisterUserRequest(
                $inputData['name'],
                $inputData['email'],
                $inputData['password']
            );

            $user = $this->useCase->execute($request);

            http_response_code(201);
            echo json_encode((new UserResponseDTO($user))->toArray());
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}
