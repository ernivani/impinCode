<?php 
// src/Repository/SectionRepository.php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class SectionRepository extends EntityRepository
{
    public function findByLessonId(int $id)
    {
        return $this->createQueryBuilder('s')
            ->where('s.lesson = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}

