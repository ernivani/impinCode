<?php 
// src/Repository/QuestionRepository.php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class QuestionRepository extends EntityRepository
{
    public function findByCourseId(int $id)
    {
        return $this->createQueryBuilder('q')
            ->where('q.course = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}

