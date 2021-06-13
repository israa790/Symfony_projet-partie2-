<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/panier1", name="cart_index")
     */
    public function index(SessionInterface $session,ProduitRepository $productRepository)
    {
        $panier=$session->get('panier',[]);
        $panierWithData=[];
        foreach($panier as $id=> $quantity)
        {
            $panierWithData []=[
            'product'=>$productRepository->find($id),
            'quantity'=>$quantity
        ];

        }
        $total=0;
        foreach($panierWithData as $item){
            $totalItem =$item['product']->getPrix()* $item['quantity'];
            $total += $totalItem;
        }
       
        return $this->render('cart/index.html.twig', [
            'items'=>$panierWithData,
            'total'=>$total
                    ]);
    }

    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */
    public function add($id,SessionInterface $session)
    {
        
        $panier=$session->get('panier',[]);
        if(!empty($panier[$id]))
        {
            $panier[$id]++;  
        }
        else
        {  $panier[$id]=1; }

        $session->set('panier',$panier);
        return $this->redirectToRoute("cart_index");
    }
/**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */
public function remove($id,SessionInterface $session)
{
    $panier=$session->get('panier',[]);
    if(!empty($panier[$id]))
    {
        unset($panier[$id]);  
    }
    $session->set('panier',$panier);
    return $this->redirectToRoute("cart_index");
}


    /**
     * Route("/commande/add/{id}", name="add_Cmd")
     */
    public function addCmd($id,SessionInterface $session)
    {
        $cmd=$session->get('cmd',[]);
        if(!empty($cmd[$id]))
        {
            $cmd[$id]++;  
        }
        else
        {  $cmd[$id]=1; }

        $session->set('cmd',$cmd);
        return $this->redirectToRoute("cart_remove");
    }
}
