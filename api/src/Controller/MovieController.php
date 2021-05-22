<?php

namespace App\Controller;

use App\Service\MovieService\MovieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    private MovieService $movieService;

    public function __construct(
        MovieService $movieService
    )
    {
        $this->movieService = $movieService;
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

        return $this->json(["numberOfElements" => count($array["results"]),"data" => $array]);
    }


}
