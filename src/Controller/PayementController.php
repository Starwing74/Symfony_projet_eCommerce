<?php

namespace App\Controller;

use App\Entity\OrderLine;
use App\Entity\Orders;
use App\Entity\User;
use App\Repository\OrderLineRepository;
use App\Repository\OrdersRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\PayementFormType;
use App\Form\Payementdto;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PayementController extends AbstractController
{
    #[Route('/payement/validate', name: 'payementvalidate')]
    public function indexvalidatepayement(\Symfony\Component\HttpFoundation\Request $request): Response
    {
        return $this->render('payement/index.html.twig', [
            'controller_name' => 'PayementController',
        ]);
    }

    #[Route('/payement', name: 'payement')]
    public function index(\Symfony\Component\HttpFoundation\Request $request, ProductRepository $productRepo, UserRepository $userRepo, OrdersRepository $orderRepo, OrderLineRepository $orderLineRepo): Response
    {
        $dto = new Payementdto();
        $CurrentTime = new \DateTime();

        $form = $this->createForm(
            PayementFormType::class,
            $dto
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (($CurrentTime->format('Y') <= $dto->Date_year)) {
                if (($CurrentTime->format('m') <= $dto->Date_month)) {
                    $string = $dto->Nbcarte;
                    $rest = substr($string, 0, 4);
                    $new_transaction_db[] = [
                        'NBcarte' => $rest,
                        'Month' => $dto->Date_month,
                        'Year' => $dto->Date_year,
                        'CVC' => $dto->CVC
                    ];
                    $session = $request->getSession();
                    $panierLists = $session->get('panierList', []);

                    /** @var User $user */
                    $user = $this->getUser();

                    $order = new Orders();
                    $order->setUserId($user);
                    $order->setDate(new \DateTime());
                    $order->setAddress($user->getAdresse());
                    $order->setStatus("Payée");

                    $orderRepo->save($order);

                    foreach ($panierLists as $panierList)
                    {
                        $findId = $panierList['product']->getId();
                        $orderline = new OrderLine();
                        $orderline->setProductId($productRepo->find($findId));
                        $orderline->setOrderId($order);
                        $orderline->setQuantity($panierList['quantity']);
                        $orderline->setPrice($panierList['product']->getPrice());
                        $orderLineRepo->save($orderline);
                    }

                    return $this->redirectToRoute("status" , ['id'=> $order->getId()]);
                }
                else{
                    dd("Your card is expired from the month");
                }
            }
            else {
                dd("Your card is expired from the year");
            }
        }

        return $this->render('payement/index.html.twig', [
            'controller_name' => 'PayementController',
            'form' => $form->createView(),
        ]);
    }
}
