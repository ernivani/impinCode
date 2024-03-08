<?php 
// src/Repository/UnitRepository.php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class UnitRepository extends EntityRepository
{
    public function findBySectionId(int $id)
    {
        return $this->createQueryBuilder('s')
            ->where('s.section = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

    public function findOneNextBySection( $sectionId,  $unitId)
    {
        return $this->createQueryBuilder('s')
            ->where('s.section = :sectionId')
            ->andWhere('s.id > :unitId')
            ->setParameter('sectionId', $sectionId)
            ->setParameter('unitId', $unitId)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

