<?php

namespace App\Controller;

use App\Service\CommentService\CommentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    private CommentService $commentService;

    public function __construct(
        CommentService $commentService
    )
    {
        $this->commentService = $commentService;
    }

    /**
     * @Route("/api/comment", name="comment.addComment", methods="POST")
     * @param Request $request
     * @return Response
     */
    public function addComment(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        if($this->commentService->addComment($data)){
            return new Response("Comment added",Response::HTTP_CREATED);
        }
        return new Response("Something went wrong", Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/api/comment", name="comment.delComment", methods="DELETE")
     * @param Request $request
     * @return Response
     */
    public function delComment(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        if($this->commentService->delComment($data)) {
            return new Response("Comment deleted",Response::HTTP_OK);
        }
        return new Response("Something went wrong", Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/api/comments/{id_movie}", name="comment.delComment", methods="GET")
     * @return Response
     */
    public function getComments(int $id_movie): Response
    {
        $arr = $this->commentService->getComments($id_movie);

        return $this->json([
            'comments' => $arr,
        ]);
    }
}
