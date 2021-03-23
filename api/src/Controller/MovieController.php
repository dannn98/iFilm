<?php

namespace App\Controller;

use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/api/movies", name="movies.index", methods="GET")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Trailery!',
            'path' => 'src/Controller/MovieController.php',
        ]);
    }

    /**
     * @Route("/api/movies/trailers", name="movie.trailers.indexTrailers", methods="GET")
     */
    public function indexTrailers(): Response
    {
        return $this->json([
            'message' => 'Trailery!',
            'path' => 'src/Controller/MovieController.php',
        ]);
    }

    /**
     * @Route("/api/movies/{id}", name="movie.show", requirements={"id"="\d+"}, methods="GET")
     */
    public function show(int $id): Response
    {
        return $this->json([
            'message' => 'Trailery!',
            'path' => 'src/Controller/MovieController.php',
        ]);
    }
}
