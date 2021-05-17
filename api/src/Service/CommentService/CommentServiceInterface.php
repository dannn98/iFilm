<?php


namespace App\Service\CommentService;


interface CommentServiceInterface
{
    public function addComment(array $arr): bool;
    public function delComment(array $arr): bool;
    public function getComments(int $id_movie): ?array;
}