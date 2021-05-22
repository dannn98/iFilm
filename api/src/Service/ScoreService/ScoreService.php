<?php


namespace App\Service\ScoreService;


use App\Entity\Score;
use App\Entity\User;
use App\Repository\ScoreRepository;

class ScoreService implements ScoreServiceInterface
{
    private ScoreRepository $repo;

    public function __construct(
        ScoreRepository $repo
    )
    {
        $this->repo = $repo;
    }

    public function addScore(User $user, $arr): bool
    {
        $score = new Score();

        if(!$arr) return false;

        $score->setIdMovie($arr["id_movie"])->setUser($user)->setScore($arr["score"]);

        $row = $this->repo->findOneBy(["id_movie" => $score->getIdMovie(), "user" => $user->getId()]);
        if($row)
        {
            if($row->getScore() === $score->getScore()) return true;

            $row->setScore($score->getScore());
            return $this->repo->save($row) !== null;
        }

        return $this->repo->save($score) !== null;
    }

    public function getScore(int $id_movie): ?array
    {
        return $this->repo->getScoreByIdMovie($id_movie);
    }
}