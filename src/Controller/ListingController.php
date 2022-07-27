<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Entity\Product;
use http\Env\Request;
use MongoDB\Driver\WriteResult;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListingController extends AbstractController
{

    #[Route('/listing', name: 'listing', methods: ["GET", "POST"])]
    public function index(ProductRepository $product, CategoryRepository $categorie): Response
    {
        return $this->render('listing/index.html.twig', [
            'controller_name' => 'ListingController',
            'products' => $product->findAll(),
            'categories' => $categorie->findAll()
        ]);
    }

    #[Route('/listing/{id}', name: 'listing_categorie')]
    public function index_categorie(Category $categorie ,ProductRepository $product, CategoryRepository $categorieRepo): Response
    {

        return $this->render('listing/index.html.twig', [
            'controller_name' => 'ListingController',
            'products' => $product->findBy(['category_id'=>$categorie->getId()]),
            'categories' => $categorieRepo->findAll()
        ]);
    }

    #[Route('/listing_panier/{id}', name: 'listing_panier')]
    public function index_panier(int $id, ProductRepository $productRepo, CategoryRepository $categorieRepo, Product $product, \Symfony\Component\HttpFoundation\Request $request): Response
    {
        $session = $request->getSession();

        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier',$panier);

        return $this->render('listing/index.html.twig', [
            'controller_name' => 'ListingController',
            'products' => $productRepo->findAll(),
            'categories' => $categorieRepo->findAll()
        ]);
    }
}
