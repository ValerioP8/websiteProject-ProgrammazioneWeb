<?php
namespace App\Service;

use App\Entity\EImage;
use Doctrine\ORM\EntityManagerInterface;

class EImageService {
    // EntityManager Injection
    private EntityManagerInterface $entityManager;

    // Constructor - Here the injection happens.
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    // Get EImage by ID
    public function getImageById(int $imageId): ?EImage {
        return $this->entityManager->getRepository(EImage::class)->find($imageId);
    }

    // Create a new EImage in DB
    public function createImage(EImage $image): void {
        $this->entityManager->persist($image);       //Add in buffer
        $this->entityManager->flush();              //Commit in DB
    }

    // Update an existing EImage in DB
    public function updateImage(EImage $image): void {
        $this->entityManager->merge($image);         //Update in buffer
        $this->entityManager->flush();              //Commit in DB
    }
}
