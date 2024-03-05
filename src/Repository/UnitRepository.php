<?php 
// src/Repository/UnitRepository.php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class UnitRepository extends EntityRepository
{
    public function findBySectionId(int $id)
    {
        return $this->createQueryBuilder('s')
            ->where('s.section = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}

