<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
class UserNotVIPController extends AbstractController
{
    #[Route('/users-not-vip', name: 'users_not_vip', methods: ['GET'])]
    public function getNotVIPUsers(UserRepository $userRepository, SerializerInterface $serializer): Response
    {
        $users = $userRepository->findAll();

        $filteredUsers = array_filter($users, function ($user) {
            return !$user->isAdmin() && !$user->isVIP() && !$user->isVVIP();
        });

        $response = array('users' => [...$filteredUsers]);

        $jsonObject = $serializer->serialize($response, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        return new Response($jsonObject, 200, ["Content-Type" => "application/json"]);
    }
}
