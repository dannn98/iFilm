<?php


namespace App\Service\MovieService;


interface MovieServiceInterface
{
    public function getMovieDetails(int $id_movie): ?array;
    public function getMovieList(int $page): ?array;
}