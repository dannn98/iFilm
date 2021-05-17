<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\WatchList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WatchList|null find($id, $lockMode = null, $lockVersion = null)
 * @method WatchList|null findOneBy(array $criteria, array $orderBy = null)
 * @method WatchList[]    findAll()
 * @method WatchList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WatchListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WatchList::class);
    }

    public function save(WatchList $watchListEntity)
    {
        try {
            $this->getEntityManager()->persist($watchListEntity);
            $this->getEntityManager()->flush();
        } catch (ORMException|OptimisticLockException $e) {
            return null;
        }
        return $watchListEntity;
    }

    public function remove(WatchList $watchListEntity): bool
    {
        try {
            $this->getEntityManager()->remove($watchListEntity);
            $this->getEntityManager()->flush();
        } catch (ORMException|OptimisticLockException $e) {
            return false;
        }
        return true;
    }

    public function getWatchlist(int $user_id): ?array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('w.id', 'u.email', 'w.id_movie', 'w.watched')
            ->from(WatchList::class, 'w')
            ->join(User::class, 'u', Join::WITH, 'w.user = u.id')
            ->where('u.id = :user_id')
            ->setParameter('user_id', $user_id);

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
