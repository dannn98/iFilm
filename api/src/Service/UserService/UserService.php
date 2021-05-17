<?php


namespace App\Service\UserService;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService implements UserServiceInterface
{
    private UserRepository $repo;
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(
        UserRepository $repo,
        UserPasswordEncoderInterface $passwordEncoder
    )
    {
        $this->repo = $repo;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function addUser(array $arr): bool{
        $user = new User();

        if(!$arr) return false;

        //If duplication
        if($this->repo->findOneBy(['email' => $arr["email"]])) return false;

        $user->setEmail($arr["email"])->setPassword($this->passwordEncoder->encodePassword($user, $arr["password"]));

        return $this->repo->save($user) !== null;
    }
}