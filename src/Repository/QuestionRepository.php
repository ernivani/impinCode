<?php 
// src/Repository/QuestionRepository.php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class QuestionRepository extends EntityRepository
{
    public function findByLessonId(int $id)
    {
        return $this->createQueryBuilder('q')
            ->where('q.lesson = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}

