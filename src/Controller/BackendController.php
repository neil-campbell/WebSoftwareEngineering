<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Login;
use App\Entity\Products;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;   

class BackendController extends AbstractController
{
    /**
     * @Route("/backend", name="catch") methods={"GET","POST"}
     */
    public function index()
    {
        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.
        $type = $request->request->get('type', 'none'); // to send ourself in different directions
        
        if($type == 'register'){
            // perform register process
            
            // get the variables
            $username = $request->request->get('username', 'none');
            $password = $request->request->get('password', 'none');
            $acctype = $request->request->get('acctype', 'none');
                        
            // put in the database            
             $entityManager = $this->getDoctrine()->getManager();

              $login = new Login();
              $login->setUsername($username);
              $login->setPassword($password);
              $login->setAcctype($acctype);

             $entityManager->persist($login);

             // actually executes the queries (i.e. the INSERT query)
             $entityManager->flush();             
                        
             return new Response(
                     'register page was called!'
                    );
            
        }
        else if($type == 'login'){ // if we had a login

            // get the username and password
            $username = $request->request->get('username', 'none');
            $password = $request->request->get('password', 'none');
            $repo = $this->getDoctrine()->getRepository(Login::class); // the type of the entity

            $person = $repo->findOneBy([

                'username' => $username,
                'password' => $password,
                ]);
                return new Response(
                    $person->getAcctype()
                    );               
        }else if($type == 'addProducts'){
            $name = $request->request->get('name', 'none');
            $ptype = $request->request->get('ptype', 'none');
            $price = $request->request->get('price', 'none');
            $image = $request->request->get('image', 'none');
           
             // put in the database            
             $entityManager = $this->getDoctrine()->getManager();

              $products = new Products();
              $products->setName($name);
              $products->setType($ptype);
              $products->setPrice($price);
              $products->setImage($image);
     
              $entityManager->persist($products);

            // actually executes the queries (i.e. the INSERT query)
             $entityManager->flush(); 

            return new Response(
                'Product added.'
               );
        }
    }
}