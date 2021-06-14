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
        $array = json_decode($response->getContent(), true);

        $array["poster_path"] = "https://image.tmdb.org/t/p/w300" . $array["poster_path"];

//        return json_decode($response->getContent(), true);
        return $array;
    }

    public function searchMovie(String $key): ?array
    {
        try {
            $response = $this->tmdb_api->request(
                'GET',
                '3/search/movie',
                ['query' => [
                    'query' => $key
                ]
            ]);
        } catch (TransportExceptionInterface $e) {
            echo $e->getMessage();
            return null;
        }

        $array = json_decode($response->getContent(), true);

        foreach($array["results"] as &$elem){
            $elem["poster_path"] = "https://image.tmdb.org/t/p/w200" . $elem["poster_path"];
        }

        return $array;
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
        $array = json_decode($response->getContent(), true);

        foreach($array["results"] as &$elem){
            $elem["poster_path"] = "https://image.tmdb.org/t/p/w200" . $elem["poster_path"];
        }

//        $array = array_map(fn($elem) => "https://image.tmdb.org/t/p/w200" . $elem["poster_path"], $array["results"]);

//        return json_decode($response->getContent(), true);
        return $array;
    }
}