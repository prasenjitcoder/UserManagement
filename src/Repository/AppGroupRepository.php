<?php

namespace App\Repository;

use App\Entity\AppGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AppGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppGroup[]    findAll()
 * @method AppGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AppGroup::class);
    }

    // /**
    //  * @return AppGroup[] Returns an array of AppGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AppGroup
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
