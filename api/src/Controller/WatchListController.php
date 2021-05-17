<?php

namespace App\Controller;

use App\Service\WatchList\WatchListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WatchListController extends AbstractController
{
    private WatchListService $watchlistService;

    public function __construct(
        WatchListService $watchlistService
    )
    {
        $this->watchlistService = $watchlistService;
    }

    /**
     * @Route("/api/watchlist", name="watchlist.addWatchlist", methods="POST")
     * @param Request $request
     * @return Response
     */
    public function addWatchlist(Request $request): Response
    {
        $user = $this->getUser();
        $data = json_decode($request->getContent(), true);

        if($this->watchlistService->addWatchlist($user, $data)){
            return new Response("Movie added to Watchlist",Response::HTTP_CREATED);
        }
        return new Response("Something went wrong", Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/api/watchlist", name="watchlist.getWatchlist", methods="GET")
     */
    public function getWatchlist(): Response
    {
        $user = $this->getUser();
        $arr = $this->watchlistService->getWatchlist($user);

        return $this->json([
            'watchlist' => $arr,
        ]);
    }

    /**
     * @Route("/api/watchlist", name="watchlist.delWatchlist", methods="DELETE")
     * @param Request $request
     * @return Response
     */
    public function delWatchlist(Request $request): Response
    {
        $user = $this->getUser();
        $data = json_decode($request->getContent(), true);

        if($this->watchlistService->delWatchlist($user, $data)){
            return new Response("Movie deleted from Watchlist",Response::HTTP_OK);
        }
        return new Response("Something went wrong", Response::HTTP_BAD_REQUEST);
    }
}
