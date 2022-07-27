<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'accueil')]
    public function index(UserRepository $user): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'users' => $user->findAll()
        ]);
    }



}
