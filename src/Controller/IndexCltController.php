<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexCltController extends AbstractController
{
    /**
     * @Route("/clt", name="index_clt")
     */
    public function index(): Response
    {
        return $this->render('index_clt/index.html.twig', [
            'controller_name' => 'IndexCltController',
        ]);
    }



}
