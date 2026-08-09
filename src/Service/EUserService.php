<?php
namespace App\Service;

use App\Entity\EUser;
use Doctrine\ORM\EntityManagerInterface;

class EUserService {
    // EntityManager Injection
    private EntityManagerInterface $entityManager;

    // Constructor - Here the injection happens.
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    // Get EUser by ID
    public function getUserById(int $userId): ?EUser {
        return $this->entityManager->getRepository(EUser::class)->find($userId);
    }

    // Create a new EUser in DB
    public function createUser(EUser $user): void {
        $this->entityManager->persist($user);       //Add in buffer
        $this->entityManager->flush();              //Commit in DB
    }

    // Update an existing EUser in DB
    public function updateUser(EUser $user): void {
        $this->entityManager->merge($user);         //Update in buffer
        $this->entityManager->flush();              //Commit in DB
    }

    // Generate a test user in DB
    public function generateTestUser(): int {
        $user = new EUser(0,"TestUser","1234","+39 1234567890","test@gmail.com");
        $this->entityManager->persist($user);         //Update in buffer
        $this->entityManager->flush();              //Commit in DB
        return 1;
    }
}