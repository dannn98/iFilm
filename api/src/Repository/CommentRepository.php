<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Driver\Exception;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
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
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT c.id as id, id_movie, u.email as email, c.comment
            FROM comment c
            JOIN public.user u ON c.user_id = u.id
            WHERE id_movie = :id_movie
        ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['id_movie' => $id_movie]);

        try {
            return $stmt->fetchAllAssociative();
        } catch (Exception $e) {
            return null;
        }
    }
}
