<?php


namespace App\Service\CommentService;

use App\Entity\User;

interface CommentServiceInterface
{
    public function addComment(User $user, array $arr): bool;
    public function delComment(User $user, array $arr): bool;
    public function getComments(int $id_movie): ?array;
}