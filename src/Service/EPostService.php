<?php
namespace App\Service;

use App\Entity\EPost;
use Doctrine\ORM\EntityManagerInterface;

class EPostService {
    // EntityManager Injection
    private EntityManagerInterface $entityManager;

    // Constructor - Here the injection happens.
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    // Get EPost by ID
    public function getPostById(int $postId): ?EPost {
        return $this->entityManager->getRepository(EPost::class)->find($postId);
    }

    // Create a new EPost in DB
    public function createPost(EPost $post): void {
        $this->entityManager->persist($post);       //Add in buffer
        $this->entityManager->flush();              //Commit in DB
    }

    // Update an existing EPost in DB
    public function updatePost(EPost $post): void {
        $this->entityManager->merge($post);         //Update in buffer
        $this->entityManager->flush();              //Commit in DB
    }

}