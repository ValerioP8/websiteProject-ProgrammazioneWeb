<?php
namespace App\Service;

use App\Entity\EPost;
use App\Repository\EPostRepository;
use Doctrine\ORM\EntityManagerInterface;

class EPostService extends AbstractBaseService {

    protected EPostRepository $postRepository;

    //Constructor override to inject EPostRepository
    public function __construct(EntityManagerInterface $entityManager, EPostRepository $postRepository) {
        parent::__construct($entityManager, EPost::class);
        $this->postRepository = $postRepository;
        $this->entityManager = $entityManager;
    }

    // Search posts by term using FULLTEXT search
    public function searchByFULLTEXT(string $searchQuery): array{
        
        // Cleanup input query
        $cleanQuery = trim($searchQuery);

        // If the string is too short, skip.
        if (mb_strlen($cleanQuery) < 3) {
            return [];
        }

        $results = $this->postRepository->searchPostsByTerm($cleanQuery);

        return $results;
    }

}