<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function save(Comment $commentEntity) {
        try {
            $this->getEntityManager()->persist($commentEntity);
            $this->getEntityManager()->flush();
        } catch (ORMException|OptimisticLockException $e) {
            return null;
        }
        return $commentEntity;
    }

    public function remove(Comment $commentEntity): bool {
        try {
            $this->getEntityManager()->remove($commentEntity);
            $this->getEntityManager()->flush();
        } catch (ORMException|OptimisticLockException $e) {
            return false;
        }
        return true;
    }

    public function getCommentsByIdMovie(int $id_movie): ?array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('c.id', 'u.email', 'c.id_movie', 'c.comment')
            ->from(Comment::class, 'c')
            ->join(User::class, 'u', Join::WITH, 'c.user = u.id')
            ->where('c.id_movie = :id_movie')
            ->setParameter('id_movie', $id_movie);

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
