<?php

namespace App\Repository;

use App\Entity\WatchListDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WatchListDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method WatchListDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method WatchListDetails[]    findAll()
 * @method WatchListDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WatchListDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WatchListDetails::class);
    }

    // /**
    //  * @return WatchListDetails[] Returns an array of WatchListDetails objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WatchListDetails
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
