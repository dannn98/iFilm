<?php


namespace App\Service\CommentService;


use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;

class CommentService implements CommentServiceInterface
{
    private CommentRepository $repo;
    private UserRepository $userRepo;

    public function __construct(
        CommentRepository $repo,
        UserRepository $userRepo
    )
    {
        $this->repo = $repo;
        $this->userRepo = $userRepo;
    }

    public function addComment(array $arr): bool {
        $comment = new Comment();

        if(!$arr) return false;

        $comment->setIdMovie($arr["id_movie"])->setUser($this->userRepo->find($arr["id_user"]))->setComment($arr["comment"]);

        return $this->repo->save($comment) !== null;
    }

    public function delComment(array $arr): bool {
        $comment = $this->repo->find($arr["id"]);

        if(!$comment) return false;

        return $this->repo->remove($comment);
    }

    public function getComments(int $id_movie): ?array {
        return $this->repo->getCommentsByIdMovie($id_movie);
    }
}