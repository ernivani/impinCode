<?php 
// src/Repository/LessonRepository.php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class LessonRepository extends EntityRepository
{
    public function findByUnitId(int $id)
    {
        return $this->createQueryBuilder('l')
            ->where('l.unit = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}

