<?php

namespace App\Repository;

use App\Entity\DescriptionExcursion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DescriptionExcursion|null find($id, $lockMode = null, $lockVersion = null)
 * @method DescriptionExcursion|null findOneBy(array $criteria, array $orderBy = null)
 * @method DescriptionExcursion[]    findAll()
 * @method DescriptionExcursion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DescriptionExcursionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DescriptionExcursion::class);
    }

    // /**
    //  * @return DescriptionExcursion[] Returns an array of DescriptionExcursion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DescriptionExcursion
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
