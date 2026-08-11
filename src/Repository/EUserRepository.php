<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\EUser;

class EUserRepository extends EntityRepository{
    
    public function searchByUsername(string $term): array{
        return $this->createQueryBuilder('u')
            ->where('u.username LIKE :term')
            ->setParameter('term', $term . '%') // Similar search to "autocomplete" functionality.
            ->setMaxResults(10) // Limit the number of results to 10 for performance.
            ->getQuery()
            ->getResult();
    }
}