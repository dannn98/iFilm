<?php


namespace App\Service\CommentService;


use App\Entity\Comment;
use App\Entity\User;
use App\Repository\CommentRepository;

class CommentService implements CommentServiceInterface
{
    private CommentRepository $repo;

    public function __construct(
        CommentRepository $repo,
    )
    {
        $this->repo = $repo;
    }

    public function addComment(User $user, array $arr): bool {
        $comment = new Comment();

        if(!$arr) return false;

        $comment->setIdMovie($arr["id_movie"])->setUser($user)->setComment($arr["comment"]);

        return $this->repo->save($comment) !== null;
    }

    public function delComment(User $user, array $arr): bool {
        $comment = $this->repo->findOneBy(["id" => $arr["id"], "user" => $user]);

        if(!$comment) return false;

        return $this->repo->remove($comment);
    }

    public function getComments(int $id_movie): ?array {
        return $this->repo->getCommentsByIdMovie($id_movie);
    }
}