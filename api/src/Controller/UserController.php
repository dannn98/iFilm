<?php

namespace App\Controller;

use App\Service\UserService\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private UserService $userService;

    public function __construct(
        UserService $userService
    )
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/api/user", name="user.addUser", methods="POST")
     * @param Request $request
     * @return Response
     */
    public function addUser(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        if($this->userService->addUser($data)){
            return new Response("User added",Response::HTTP_CREATED);
        }
        return new Response("Something went wrong", Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/api/user", name="user.delUser", methods="DELETE")
     */
    public function delUser(): Response
    {
        return $this->json([
            'message' => 'Not implemented',
        ]);
    }
}
