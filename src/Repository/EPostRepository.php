<?php

namespace App\Repository;

use App\Entity\EPost;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\ORM\EntityRepository;

class EPostRepository extends EntityRepository{
    //FULLTEXT search
    public function searchPostsByTerm(string $term): array{
        $entityManager = $this->getEntityManager();

        // Convert raw SQL result into EPost entities
        $rsm = new ResultSetMappingBuilder($entityManager);
        $rsm->addRootEntityFromClassMetadata(EPost::class, 'p');

        // Native SQL query using FULLTEXT search
        $sql = "SELECT p.* FROM posts p 
                WHERE MATCH(p.title, p.content) AGAINST(:term IN BOOLEAN MODE)
                LIMIT 20";

        $query = $entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('term', $term . '*'); // '*' search for partial matches

        return $query->getResult();
    }
}