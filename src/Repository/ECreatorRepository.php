<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class ECreatorRepository extends EntityRepository{
    public function searchByUsername(string $term): array{
        return $this->createQueryBuilder('c')
            ->where('c.username LIKE :term OR c.email LIKE :term')
            ->setParameter('term', '%' . $term . '%')
            ->getQuery()
            ->getResult();
    }
}