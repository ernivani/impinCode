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

    public function findOneNextByUnit( $unitId,  $lessonId)
    {
        return $this->createQueryBuilder('l')
            ->where('l.unit = :unitId')
            ->andWhere('l.ordre > :lessonId')
            ->setParameter('unitId', $unitId)
            ->setParameter('lessonId', $lessonId->getOrdre())
            ->orderBy('l.ordre', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

