<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends AbstractController
{
    #[Route('produit', name: 'produit')]
    public function number(): Response
    {
        return $this->render('/main/index.html.twig',['page' => 'produit']);
    }
}