<?php

namespace App\Controller;

use App\Service\ScoreService\ScoreService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScoreController extends AbstractController
{
    private ScoreService $scoreService;

    public function __construct(
        ScoreService $scoreService
    )
    {
        $this->scoreService = $scoreService;
    }

    /**
     * @Route("/api/score", name="movie.addScore", methods="POST")
     * @param Request $request
     * @return Response
     */
    public function addScore(Request $request): Response
    {
        $user = $this->getUser();
        $data = json_decode($request->getContent(), true);

        if($this->scoreService->addScore($user, $data)){
            return new Response("Score added",Response::HTTP_CREATED);
        }
        return new Response("Something went wrong", Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/api/score/{id_movie}", name="movie.getScore", methods="GET")
     * @param int $id_movie
     * @return Response
     */
    public function getScore(int $id_movie): Response
    {
        $array = $this->scoreService->getScore($id_movie);

        return $this->json($array);
    }


}
