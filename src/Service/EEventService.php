<?php

namespace App\Service;
use App\Entity\EEvent;
use Doctrine\ORM\EntityManagerInterface;

class EEventService {
    // EntityManager Injection
    private EntityManagerInterface $entityManager;

    // Constructor - Here the injection happens.
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    // Get EEvent by ID
    public function getEventById(int $eventId): ?EEvent {
        return $this->entityManager->getRepository(EEvent::class)->find($eventId);
    }

    // Create a new EEvent in DB
    public function createEvent(EEvent $event): void {
        $this->entityManager->persist($event);       //Add in buffer
        $this->entityManager->flush();              //Commit in DB
    }

    // Update an existing EEvent in DB
    public function updateEvent(EEvent $event): void {
        $this->entityManager->merge($event);         //Update in buffer
        $this->entityManager->flush();              //Commit in DB
    }
}