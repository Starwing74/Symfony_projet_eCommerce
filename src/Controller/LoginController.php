<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(AuthenticationUtils $authentificationUtils, UserRepository $userRepository): Response
    {
        $errors = $authentificationUtils->getLastAuthenticationError();
        $lastUserName = $authentificationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'error' => $errors,
            'last_username' => $lastUserName,
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
        throw new \Exception( message: 'On ne passe pas ici');
    }
}
