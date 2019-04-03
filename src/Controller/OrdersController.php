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
     * @Route("/orders", name="orders") methods={"GET","POST"}
     */
    public function index(){
        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.
        $type = $request->request->get('type', 'none'); // to send ourself in different directions
        
        if($type == 'orders'){
            $userId = $request->request->get('userId', 'none');
            $prdId = $request->request->get('prdId', 'none');
            $quantity = $request->request->get('quantity', 'none');
            $address = $request->request->get('address', 'none');
            $phone = $request->request->get('phone', 'none');
            $status = $request->request->get('status', 'none');
           
             // put in the database            
             $entityManager = $this->getDoctrine()->getManager();

              $orders = new Orders();
              $orders->setUserId($userId);
              $orders->setPrdId($prdId);
              $orders->setQuantity($quantity);
              $orders->setAddress($address);
              $orders->setPhone($phone);
              $orders->setStatus($status);
     
              $entityManager->persist($orders);

            // actually executes the queries (i.e. the INSERT query)
             $entityManager->flush();

            return new Response(
                'Order added.'
               );
        }
    }
}
    