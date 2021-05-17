<?php


namespace App\Service\WatchList;


use App\Entity\User;

interface WatchListServiceInterface
{
    public function addWatchlist(User $user, array $arr): bool;
    public function getWatchlist(User $user): ?array;
    public function delWatchlist(User $user, array $arr): bool;
}