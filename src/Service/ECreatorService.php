<?php
namespace App\Service;

use App\Entity\ECreator;
use App\Repository\ECreatorRepository;
use Doctrine\ORM\EntityManagerInterface;

class ECreatorService extends AbstractBaseService {
    protected ECreatorRepository $creatorRepository;

    //  Override
    public function __construct(EntityManagerInterface $entityManager, ECreatorRepository $creatorRepository) {
        parent::__construct($entityManager, User::class);
        $this->entityManager = $entityManager;
        $this->creatorRepository = $creatorRepository;
    }

    //Verify
    public function verifyPassword(ECreator $creator, string $password): bool{
        return password_verify($password, $creator->getPasswordHash());
    }

    //Utility

    public function searchByUsername(string $searchQuery): array{
        $cleanQuery = trim($searchQuery);
        if (mb_strlen($cleanQuery) < 3) {
            return [];
        }
        return $this->creatorRepository->searchByUsername($cleanQuery);
    }
}