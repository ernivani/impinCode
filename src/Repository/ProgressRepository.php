<?php 
// src/Repository/ProgressRepository.php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class ProgressRepository extends EntityRepository
{
    
    public function findOneByUserAndLesson($user, $lesson)
    {
        return $this->createQueryBuilder('p')
            ->where('p.user = :user')
            ->andWhere('p.lesson = :lesson')
            ->setParameter('user', $user)
            ->setParameter('lesson', $lesson)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

