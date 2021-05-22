<?php


namespace App\Service\ScoreService;


use App\Entity\User;

interface ScoreServiceInterface
{
    public function addScore(User $user, $arr): bool;
    public function getScore(int $id_movie): ?array;
}