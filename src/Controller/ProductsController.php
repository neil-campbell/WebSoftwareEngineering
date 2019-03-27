<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response; 

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products") methods={"GET","POST"}
     */
    public function index()
    {
        // return $this->render('products/index.html.twig', [
        //     'controller_name' => 'ProductsController',
        // ]);

        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.
        $type = $request->request->get('type', 'none'); // to send ourself in different directions
        if($type == 'add'){
            $name = $request->request->get('name', 'none');
            print_r($name);
            return new Response(
                'Product added.'
               );
        }
    }
    
    /**
     * @Route("/products/add", methods={"POST","HEAD"}, name="add")
     */
    public function addProduct(){
        // get the variables
        $name = $request->request->get('name', 'none');
        print_r($name);

        return new Response(
            'Product added.'
           );
    } 
}
