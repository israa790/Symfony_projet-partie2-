<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="commande")
     */
    public function index()
    {
       
        return $this->render('commande/index.html.twig', [
           
        ]);
    }

    /**
     * Route("/commande/add2/{id}", name="addc")
     */
    public function add($id,Request $request)
    {
        $session = $request->getSession();
        $cmd=$session->get('cmd', []);
        $cmd[$id]=1;

        $session->set('cmd',$cmd);
        dd($session->get('cmd'));
      
    }
}
