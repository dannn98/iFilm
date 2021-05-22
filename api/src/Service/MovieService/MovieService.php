<?php


namespace App\Service\MovieService;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MovieService implements MovieServiceInterface
{
    private HttpClientInterface $tmdb_api;

    public function __construct(
        HttpClientInterface $tmdb_api
    )
    {
        $this->tmdb_api = $tmdb_api;
    }

    public function getMovieDetails(int $id_movie): ?array
    {
        try {
            $response = $this->tmdb_api->request(
                'GET',
                '/3/movie/'.$id_movie,
            );
        } catch (TransportExceptionInterface $e) {
            echo $e->getMessage();
            return null;
        }

        return json_decode($response->getContent(), true);
    }

    public function getMovieList(int $page): ?array
    {
        try {
            $response = $this->tmdb_api->request(
                'GET',
                '/3/movie/popular',
                ['query' => [
                    'page' => $page
                ]
            ]);
        } catch (TransportExceptionInterface $e) {
            echo $e->getMessage();
            return null;
        }

        return json_decode($response->getContent(), true);
    }
}