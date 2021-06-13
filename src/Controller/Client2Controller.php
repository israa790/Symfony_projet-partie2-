<?php

namespace App\Controller;

use App\Entity\Client2;
use App\Form\Client2Type;
use App\Repository\Client2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client2")
 */
class Client2Controller extends AbstractController
{
    /**
     * @Route("/", name="client2_index", methods={"GET"})
     */
    public function index(Client2Repository $client2Repository): Response
    {
        return $this->render('client2/index.html.twig', [
            'client2s' => $client2Repository->findAll(),
        ]);
    }

/**
 * @Route("/security_login" ,name="security_login" , methods={"GET","POST"})
 */
public function login()
{
    return $this->render('client2/login_client.html.twig');
}


/**
 * @Route("/deconnexion" ,name="security_logout" , methods={"GET","POST"})
 */
public function logout()
{

}

// ajouter client pour s'inscrire 
/**
     * @Route("/new", name="clt_new", methods={"GET","POST"})
     */
    public function newClt(Request $request): Response
    {
        $client2 = new Client2();
        $form = $this->createForm(Client2Type::class, $client2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client2);
            $entityManager->flush();

            return $this->redirectToRoute('index_clt');
        }

        return $this->render('client2/vue_new_client.html.twig', [
            'client2' => $client2,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/new_clt", name="client2_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $client2 = new Client2();
        $form = $this->createForm(Client2Type::class, $client2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client2);
            $entityManager->flush();

            return $this->redirectToRoute('client2_index');
        }

        return $this->render('client2/new.html.twig', [
            'client2' => $client2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="client2_show", methods={"GET"})
     */
    public function show(Client2 $client2): Response
    {
        return $this->render('client2/show.html.twig', [
            'client2' => $client2,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="client2_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Client2 $client2): Response
    {
        $form = $this->createForm(Client2Type::class, $client2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('client2_index');
        }

        return $this->render('client2/edit.html.twig', [
            'client2' => $client2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="client2_delete", methods={"POST"})
     */
    public function delete(Request $request, Client2 $client2): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client2->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($client2);
            $entityManager->flush();
        }

        return $this->redirectToRoute('client2_index');
    }
}
