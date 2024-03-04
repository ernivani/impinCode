<?php 
// src/Repository/LessonRepository.php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class LessonRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->createQueryBuilder('l')
            ->getQuery()
            ->getResult();
    }
}

