<?php
namespace App\Service;

use App\Entity\EComment;
use Doctrine\ORM\EntityManagerInterface;

class ECommentService {
    // EntityManager Injection
    private EntityManagerInterface $entityManager;

    // Constructor - Here the injection happens.
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    // Get EComment by ID
    public function getCommentById(int $commentId): ?EComment {
        return $this->entityManager->getRepository(EComment::class)->find($commentId);
    }

    // Create a new EComment in DB
    public function createComment(EComment $comment): void {
        $this->entityManager->persist($comment);       //Add in buffer
        $this->entityManager->flush();              //Commit in DB
    }

    // Update an existing EComment in DB
    public function updateComment(EComment $comment): void {
        $this->entityManager->merge($comment);         //Update in buffer
        $this->entityManager->flush();              //Commit in DB
    }
}