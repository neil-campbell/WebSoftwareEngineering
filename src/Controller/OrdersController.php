<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Orders;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends AbstractController
{
    /**
     * @Route("/orders", name="orders") methods={"GET"}
     */
    public function index(){
        $repo = $this->getDoctrine()->getRepository(Orders::class); // the type of the entity
        $orders = $repo->findAll();
        if (!$orders) {
            throw $this->createNotFoundException(
                'An unknown error has occured while getting reading Orders from table.'
            );
        }
        return new JsonResponse($orders);    
    }

    /**
     * @Route("/orders/save", name="saveOrders") methods={"POST"}
     */
    public function saveOrders(){
        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.
        $userId = $request->request->get('userId', 'none');
        $address = $request->request->get('address', 'none');
        $phone = $request->request->get('phone', 'none');
        $status = $request->request->get('status', 'none');
        $total_cart_price = $request->request->get('total_cart_price', 'none');
        $order_data = $request->request->get('order_data', 'none');
        
        // put in the database            
        $entityManager = $this->getDoctrine()->getManager();

        $orders = new Orders();
        $orders->setUserId($userId);
        $orders->setAddress($address);
        $orders->setPhone($phone);
        $orders->setStatus($status);
        $orders->setTotalCartPrice($total_cart_price);
        $orders->setOrderData($order_data);

        $entityManager->persist($orders);

    // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush(); 

        return new Response(
            'A new Order has been added.'
        );
    }
}
    
