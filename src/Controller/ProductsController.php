<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Products;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products") methods={"GET","POST"}
     */
    public function index(){
        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.
        $type = $request->request->get('type', 'none'); // to send ourself in different directions
        
        if($type == 'add'){
            $name = $request->request->get('name', 'none');
            $ptype = $request->request->get('ptype', 'none');
            $price = $request->request->get('price', 'none');
            $image = $request->request->get('image', 'none');
            $size = $request->request->get('size', 'none');
           
             // put in the database            
             $entityManager = $this->getDoctrine()->getManager();

              $products = new Products();
              $products->setName($name);
              $products->setType($ptype);
              $products->setPrice($price);
              $products->setImage($image);
              $products->setSize($size);
     
              $entityManager->persist($products);

            // actually executes the queries (i.e. the INSERT query)
             $entityManager->flush(); 

            return new Response(
                'Product added.'
               );
        }
    }

    /**
     * @Route("/products/getProducts", name="getProducts") methods={"GET"}
     */
    public function getProducts(){
        $repo = $this->getDoctrine()->getRepository(Products::class); // the type of the entity
        $products = $repo->findAll();
        if (!$products) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return new JsonResponse($products);     
    }
}
    