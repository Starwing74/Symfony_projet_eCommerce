<?php

namespace App\Controller;

use App\Entity\Note;
use App\Entity\OrderLine;
use App\Entity\Orders;
use App\Form\Reviewdto;
use App\Form\ReviewFormType;
use App\Repository\NoteRepository;
use App\Repository\OrderLineRepository;
use App\Repository\OrdersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatusController extends AbstractController
{
    #[Route('/status/Review/{id}/{idscore}/{score}', name: 'statusScore')]
    public function indexScore($id, $idscore, $score, Request $request, Orders $orders, OrdersRepository $ordersRepo): Response
    {
        $session = $request->getSession();

        $ReviewScore = $session->get('ReviewScore', []);

        $ReviewScore [$idscore] = $score;

        $session->set('ReviewScore', $ReviewScore);

        $panierList = $session->get('panierList', []);

        $dto = new Reviewdto();
        $i = 0;

        while ($i <10) {
            $form = $this->createForm(
                ReviewFormType::class,
                $dto
            );
            $i++;
        }

        $form->handleRequest($request);

        $orders->setStatus("Terminée");
        $ordersRepo->save($orders);
        return $this->render('status/index.html.twig', [
            'controller_name' => 'StatusController',
            'Commande' => $orders,
            'PanierList' => $panierList,
            'form' => $form->createView()
        ]);
    }

    #[Route('/status/finish/{id}', name: 'statusFinish')]
    public function indexFinish(Request $request, Orders $orders, OrdersRepository $ordersRepo): Response
    {
        $session = $request->getSession();

        $panierList = $session->get('panierList', []);

        $dto = new Reviewdto();
        $i = 0;

        while ($i <10) {
            $form = $this->createForm(
                ReviewFormType::class,
                $dto
            );
            $i++;
        }

        $form->handleRequest($request);

        $orders->setStatus("Terminée");
        $ordersRepo->save($orders);
        return $this->render('status/index.html.twig', [
            'controller_name' => 'StatusController',
            'Commande' => $orders,
            'PanierList' => $panierList,
            'form' => $form->createView()
        ]);
    }

    #[Route('/status/review/{id}', name: 'statusReview')]
    public function indexReview($id,Request $request, Orders $orders, OrdersRepository $ordersRepo): Response
    {
        $session = $request->getSession();
        $ReviewScore = $session->get('ReviewScore');

        dd($ReviewScore);

        $panierList = $session->get('panierList', []);
        $dto = new Reviewdto();
        $form = $this->createForm(
            ReviewFormType::class,
            $dto
        );
        $form->handleRequest($request);

        $orders->setStatus("Terminée");
        $ordersRepo->save($orders);
        return $this->render('status/index.html.twig', [
            'controller_name' => 'StatusController',
            'Commande' => $orders,
            'PanierList' => $panierList,
            'form' => $form->createView()
        ]);
    }

    #[Route('/status/{id}', name: 'status')]
    public function index($id,Request $request, Orders $orders): Response
    {

        return $this->render('status/index.html.twig', [
            'controller_name' => 'StatusController',
            'Commande' => $orders
        ]);
    }


}
