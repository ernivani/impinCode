<?php 
// src/Repository/SectionRepository.php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class SectionRepository extends EntityRepository
{
    public function findByCourseId(int $id)
    {
        return $this->createQueryBuilder('s')
            ->where('s.course = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}

