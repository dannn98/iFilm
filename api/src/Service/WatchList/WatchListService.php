<?php


namespace App\Service\WatchList;

use App\Entity\User;
use App\Entity\WatchList;
use App\Entity\WatchListDetails;
use App\Repository\WatchListRepository;

class WatchListService implements WatchListServiceInterface
{
    private WatchListRepository $repo;

    public function __construct(
        WatchListRepository $repo
    )
    {
        $this->repo = $repo;
    }

    public function addWatchlist(User $user, array $arr): bool
    {
        $watchlist = new WatchList();

        if(!$arr) return false;

        $watchlist->setIdUser($user)->setIdMovie($arr["id_movie"])->setWatched($arr["watched"]);
        $watchlist->setWatchListDetails(new WatchListDetails());

        $watchlist->getWatchListDetails()->setTitle($arr["title"]);

        $row = $this->repo->findOneBy(["id_movie" => $watchlist->getIdMovie(), "user" => $user->getId()]);
        if($row)
        {
            if($row->getWatched() === $watchlist->getWatched()) return true;

            $row->setWatched($watchlist->getWatched());
            return $this->repo->save($row) !== null;
        }

        return $this->repo->save($watchlist) !== null;
    }

    public function getWatchlist(User $user): ?array
    {
        return $this->repo->getWatchlist($user->getId());
    }

    public function delWatchlist(User $user, array $arr): bool
    {
        if(!$arr) return false;

        $watchlist = $this->repo->findOneBy(["id" => $arr["id"], "user" => $user]);

        if($watchlist === null)
            return true;

        return $this->repo->remove($watchlist);
    }
}