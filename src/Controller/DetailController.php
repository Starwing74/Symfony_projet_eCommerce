<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailController extends AbstractController
{
    #[Route('/detail', name: 'detail')]
    public function index(): Response
    {
        return $this->render('detail/index.html.twig', [
            'controller_name' => 'DetailController',
        ]);
    }

    #[Route('/detail/{id}', name: 'detailId')]
    public function index_detail(Product $product): Response
    {
        return $this->render('detail/index.html.twig', [
            'controller_name' => 'DetailController',
            'product' => $product
        ]);
    }
}


