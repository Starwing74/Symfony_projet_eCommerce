<?php

namespace App\Controller;

use App\Entity\OrderLine;
use App\Entity\Orders;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\OrderLineRepository;
use App\Repository\OrdersRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index(ProductRepository $productRepo,\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $session = $request->getSession();

        $panier = $session->get('panier', []);

        $panierData = [];
        $total = 0;

        foreach ($panier as $id => $quantity)
        {
            $panierData[] = [
                'product' => $productRepo->find($id),
                'quantity' => $quantity
            ];
            $total += $productRepo->find($id)->getPrice() * $quantity;
        }

        $session->set('panierList',$panierData);

        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
            'items' => $panierData,
            'total' => $total
        ]);
    }

    #[Route('/panier/remove/{id}', name: 'panierRemove')]
    public function Remove($id,\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $session = $request->getSession();

        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier',$panier);

        return $this->redirectToRoute("panier");
    }

    #[Route('/panier/diminuer/{id}', name: 'panierDiminuer')]
    public function Diminuer($id,\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $session = $request->getSession();

        $panier = $session->get('panier', []);

        $panier[$id]--;

        $session->set('panier',$panier);

        return $this->redirectToRoute("panier");
    }

    #[Route('/panier/rajouter/{id}', name: 'panierRajouter')]
    public function Rajouter($id,\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $session = $request->getSession();

        $panier = $session->get('panier', []);

        $panier[$id]++;

        $session->set('panier',$panier);

        return $this->redirectToRoute("panier");
    }

    #[Route('/panier/Confirme/{id}', name: 'panierConfirme')]
    public function Confirme($id,\Symfony\Component\HttpFoundation\Request $request, ProductRepository $productRepo, UserRepository $userRepo, OrdersRepository $orderRepo, OrderLineRepository $orderLineRepo): Response
    {
        return $this->redirectToRoute("payement");
    }
}
