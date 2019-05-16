<?php

namespace App\Repository;

use App\Entity\GroupRoles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GroupRoles|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupRoles|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupRoles[]    findAll()
 * @method GroupRoles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupRolesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GroupRoles::class);
    }

    // /**
    //  * @return GroupRoles[] Returns an array of GroupRoles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupRoles
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
