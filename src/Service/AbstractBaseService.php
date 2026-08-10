<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

/*
    Common functions for all services must go here due to DRY.

*/

abstract class AbstractBaseService {
    // EntityManager Injection
    protected EntityManagerInterface $entityManager;

    // Constructor - Here the injection happens.
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    // Persist an entity in DB
    public function persist(object $entity): void{
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    // Remove entity from DB
    public function remove(object $entity): void{
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    // Update an entity in DB
    public function update(object $entity): void{
        $this->entityManager->merge($entity);
        $this->entityManager->flush();
    }

    // Return by ID
    public function getById(string $entityClass, int $id): ?object{
        return $this->entityManager->find($entityClass, $id);
    }

}