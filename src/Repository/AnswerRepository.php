<?php 
// src/Repository/AnswerRepository.php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class AnswerRepository extends EntityRepository
{
    public function findByQuestionId(int $id)
    {
        return $this->createQueryBuilder('a')
            ->where('a.question = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}

