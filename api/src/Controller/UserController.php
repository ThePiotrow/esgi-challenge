<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
class UserController extends AbstractController
{
    #[Route('/me', name: 'users_me', methods: ['GET'])]
    public function getMe(Security $security, UserRepository $userRepository, SerializerInterface $serializer): Response
    {
        return new Response($serializer->serialize($security->getUser(), 'json'), 200, ["Content-Type" => "application/json"]);
    }
}
