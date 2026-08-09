<?php
namespace App\Service;

use App\Entity\ECreator;
use Doctrine\ORM\EntityManagerInterface;

class ECreatorService {
    // EntityManager Injection
    private EntityManagerInterface $entityManager;

    // Constructor - Here the injection happens.
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    // Get ECreator by ID
    public function getCreatorById(int $creatorId): ?ECreator {
        return $this->entityManager->getRepository(ECreator::class)->find($creatorId);
    }

    // Create a new ECreator in DB
    public function createCreator(ECreator $creator): void {
        $this->entityManager->persist($creator);       //Add in buffer
        $this->entityManager->flush();              //Commit in DB
    }

    // Update an existing ECreator in DB
    public function updateCreator(ECreator $creator): void {
        $this->entityManager->merge($creator);         //Update in buffer
        $this->entityManager->flush();              //Commit in DB
    }

    //generate a test creator in DB
    public function generateTestCreator(): int {
        $creator = new ECreator(0,"TestCreator","1234","+39 1234567890","test@gmail.com","Abruzzo","Chieti","Caverna");
        $this->entityManager->persist($creator);         //Update in buffer
        $this->entityManager->flush();              //Commit in DB
        return 1;
    }
}