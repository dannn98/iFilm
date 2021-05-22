<?php

namespace App\Repository;

use App\Entity\Score;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Score|null find($id, $lockMode = null, $lockVersion = null)
 * @method Score|null findOneBy(array $criteria, array $orderBy = null)
 * @method Score[]    findAll()
 * @method Score[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Score::class);
    }

    public function save(Score $scoreEntity): ?Score
    {
        try {
            $this->getEntityManager()->persist($scoreEntity);
            $this->getEntityManager()->flush();
        } catch (ORMException|OptimisticLockException $e) {
            return null;
        }
        return $scoreEntity;
    }

    public function getScoreByIdMovie(int $id_movie): ?array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('AVG(s.score) as sum')
            ->from(Score::class, 's')
            ->where('s.id_movie = :id_movie')
            ->setParameter('id_movie', $id_movie);

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
