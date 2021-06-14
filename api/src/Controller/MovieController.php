<?php

namespace App\Controller;

use App\Service\CommentService\CommentService;
use App\Service\MovieService\MovieService;
use App\Service\ScoreService\ScoreService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    private MovieService $movieService;
    private ScoreService $scoreService;
    private CommentService $commentService;

    public function __construct(
        MovieService $movieService,
        ScoreService $scoreService,
        CommentService $commentService
    )
    {
        $this->movieService = $movieService;
        $this->scoreService = $scoreService;
        $this->commentService = $commentService;
    }

    /**
     * @Route("/api/movie/{id_movie}", name="movie.getMovie", methods="GET")
     * @param int $id_movie
     * @return Response
     */
    public function getMovie(int $id_movie): Response
    {
        $array = $this->movieService->getMovieDetails($id_movie);

        if(!$array) return new Response("Could not found movie with id: $id_movie", Response::HTTP_NOT_FOUND);

        $score = $this->scoreService->getScore($id_movie);
        $comments = $this->commentService->getComments($id_movie);

        return $this->json(["movie" => $array, "score" => $score["sum"], "comments" => $comments]);
    }

    /**
     * @Route("/api/search/movie", name="movie.searchMovie", methods="POST")
     * @return Response
     */
    public function searchMovie(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $key = $data["key"];

        $array = $this->movieService->searchMovie($key);

        if(!$array) return new Response("Could not found movie $key", Response::HTTP_NOT_FOUND);

        return $this->json($array);
    }

    /**
     * @Route("/api/movie/page/{page}", name="movie.getMovies", methods="GET")
     * @param int $page
     * @return Response
     */
    public function getMovies(int $page): Response
    {
        $array = $this->movieService->getMovieList($page);

        if(!$array) return new Response("Something went wrong", Response::HTTP_BAD_REQUEST);

        return $this->json($array);
    }


}
