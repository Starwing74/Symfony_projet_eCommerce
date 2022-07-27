<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionFormType;
use App\Form\Userdto;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'inscription', methods: ["GET", "POST"])]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        $dto = new Userdto();

        $form = $this->createForm(
            InscriptionFormType::class,
            $dto
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User();
            $user->setName($dto->Name);
            $user->setPassword($dto->Password);
            $user->setAdresse($dto->Mail);
            $user->setRoles("client");
            $user->setLastLogin(new \DateTime());
            $userRepository->save($user);
            return $this->redirectToRoute("login");
        }

        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
            'users' => $userRepository->findAll(),
            'form' => $form->createView(),
            'data' => null
        ]);
    }

}
