<?php 
// src/Repository/CourseRepository.php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class CourseRepository extends EntityRepository
{
    public function findByUnitId(int $id)
    {
        return $this->createQueryBuilder('c')
            ->where('c.unit = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}

