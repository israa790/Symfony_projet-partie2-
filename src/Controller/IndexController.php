<?php

namespace App\Controller;

use App\Entity\Client2;
use App\Entity\Produit;
use App\Form\Client2Type;
use App\Form\ProduitType;


use App\Entity\PriceSearch;
use App\Form\PriceSearchType;
use App\Entity\CategorySearch;
use App\Entity\PropertySearch;
use App\Form\CategorySearchType;
use App\Form\PropertySearchType;
use App\Form\PropertySearchType2;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{

/**
 *@Route("/prod_prix",name="produit_par_prix")
 *Method({"Get"})
 */
public function articlesParPrix(Request $request)
{
  $priceSearch =new PriceSearch();
  $form =$this->createForm(PriceSearchType::class,$priceSearch);
  $form->handleRequest($request);

  $produits=[];
  if($form->isSubmitted() && $form->isValid())
  {
    $minPrice=$priceSearch->getMinPrice();
    $maxPrice=$priceSearch->getMAxPrice();
    $produits=$this->getDoctrine()->getRepository(Produit::class)->findByPriceRange($minPrice,$maxPrice);
  }
  return $this->render('produit/produitParPrix.html.twig',['form'=>$form->createView(), 'produits'=>$produits]);
}

//produit_par_prixCLT


/**
 *@Route("/prod_prixclt",name="produit_par_prixCLT")
 *Method({"Get"})
 */
public function articlesParPrixclt(Request $request)
{
  $priceSearch =new PriceSearch();
  $form =$this->createForm(PriceSearchType::class,$priceSearch);
  $form->handleRequest($request);

  $produits=[];
  if($form->isSubmitted() && $form->isValid())
  {
    $minPrice=$priceSearch->getMinPrice();
    $maxPrice=$priceSearch->getMAxPrice();
    $produits=$this->getDoctrine()->getRepository(Produit::class)->findByPriceRange($minPrice,$maxPrice);
  }
  return $this->render('produit/produit_par_prixclt.html.twig',['form'=>$form->createView(), 'produits'=>$produits]);
}



  /**
    *@Route("/Rechercher_Produit",name="recherche_list")
    */
    public function home(Request $request)
    {
      $PropertySearch = new PropertySearch();
      $form = $this->createForm(PropertySearchType::class,$PropertySearch);
      $form->handleRequest($request);
     //initialement le tableau des articles est vide, 
     //c.a.d on affiche les articles que lorsque l'utilisateur clique sur le bouton rechercher
     $produits= [];
      
     if($form->isSubmitted() && $form->isValid()) {
     //on récupère le nom d'article tapé dans le formulaire
      $nomProd = $PropertySearch->getNomProd();  
      
      if ($nomProd!="" ) 
        //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
        $produits= $this->getDoctrine()->getRepository(Produit::class)->findBy(['nomProd' => $nomProd ] );
      else   
        //si si aucun nom n'est fourni on affiche tous les articles
        $produits= $this->getDoctrine()->getRepository(Produit::class)->findAll();
     }
      return  $this->render('produit/search.html.twig',[ 'form' =>$form->createView(), 'produits' => $produits]);  
    }


    ///rechercher les produits selon leurs noms vue client
    /**
    *@Route("/Rechercher_Produitclt",name="recherche_listCLT")
    */
    public function homeCLT(Request $request)
    {
      $PropertySearch = new PropertySearch();
      $form = $this->createForm(PropertySearchType::class,$PropertySearch);
      $form->handleRequest($request);
     //initialement le tableau des articles est vide, 
     //c.a.d on affiche les articles que lorsque l'utilisateur clique sur le bouton rechercher
     $produits= [];
      
     if($form->isSubmitted() && $form->isValid()) {
     //on récupère le nom d'article tapé dans le formulaire
      $nomProd = $PropertySearch->getNomProd();  
      
      if ($nomProd!="" ) 
        //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
        $produits= $this->getDoctrine()->getRepository(Produit::class)->findBy(['nomProd' => $nomProd ] );
      else   
        //si si aucun nom n'est fourni on affiche tous les articles
        $produits= $this->getDoctrine()->getRepository(Produit::class)->findAll();
     }
      return  $this->render('produit/searchCLT.html.twig',[ 'form' =>$form->createView(), 'produits' => $produits]);  
    }

    
     /**
    *@Route("/Rechercher_Client",name="recherche_client")
    */
    public function home2(Request $request)
    {
      $PropertySearch = new PropertySearch();
      $form = $this->createForm(PropertySearchType2::class,$PropertySearch);
      $form->handleRequest($request);
     //initialement le tableau des articles est vide, 
     //c.a.d on affiche les articles que lorsque l'utilisateur clique sur le bouton rechercher
     $clients= [];
      
     if($form->isSubmitted() && $form->isValid()) {
     //on récupère le nom d'article tapé dans le formulaire
      $nom = $PropertySearch->getNom();   
      if ($nom!="") 
        //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
        $clients= $this->getDoctrine()->getRepository(Client2::class)->findBy(['nom' => $nom] );
      else   
        //si si aucun nom n'est fourni on affiche tous les articles
        $clients= $this->getDoctrine()->getRepository(Client2::class)->findAll();
     }
      return  $this->render('client2/search.html.twig',[ 'form' =>$form->createView(), 'client2s' => $clients]);  
    }


   
      /**
    *@Route("/authentifier",name="authentifier_clt")
    */
   public function authentifier(Request $request)
    {
      $PropertySearch = new PropertySearch();
      $form = $this->createForm(PropertySearchType::class,$PropertySearch);
      $form->handleRequest($request);
     //initialement le tableau des articles est vide, 
     //c.a.d on affiche les articles que lorsque l'utilisateur clique sur le bouton rechercher
     $clients= [];
      
     if($form->isSubmitted() && $form->isValid()) {
     //on récupère le nom d'article tapé dans le formulaire
      $email = $PropertySearch->getEmail();
      $password = $PropertySearch->getPassword();
      if ($email!="" & $password!="") 
        //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
        $clients= $this->getDoctrine()->getRepository(Client2::class)->findBy(['email' => $email],['password'=> $password] );
      else   
        //si si aucun nom n'est fourni on affiche tous les articles
        $clients= $this->getDoctrine()->getRepository(Client2::class)->findAll();
     }
      return  $this->render('client2/authentifier.html.twig',[ 'form' =>$form->createView(), 'client2s' => $clients]);  
    }


    /**
     * @Route("/admin", name="index")
     */
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    /**
     * @Route("/PageSearch", name="SearchIndex")
     */
    public function index2(): Response
    {
        return $this->render('index/page_search.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }


    /**
     * @Route("/prod_cat/", name="produit_par_cat")
     * Method({"GET", "POST"})
     */
    public function articlesParCategorie(Request $request) {
      $categorySearch = new CategorySearch();
      $form = $this->createForm(CategorySearchType::class,$categorySearch);
      $form->handleRequest($request);

      $produits= [];

      if($form->isSubmitted() && $form->isValid()) {
        $category = $categorySearch->getCategory();
       
        if ($category!="") 
        {
          
          $produits= $category->getProduits();
         // ou bien 
         //$produits= $this->getDoctrine()->getRepository(Article::class)->findBy(['category' => $category] );
        }
        else   
        $produits= $this->getDoctrine()->getRepository(Produit::class)->findAll();
        }
      
      return $this->render('produit/produitParCategorie.html.twig',['form' => $form->createView(),'produits' => $produits]);
  }
  
  //recherche produit par categorie vue de client
    /**
     * @Route("/prod_catclt/", name="produit_par_catCLT")
     * Method({"GET", "POST"})
     */
    public function articlesParCategorieCLT(Request $request) {
      $categorySearch = new CategorySearch();
      $form = $this->createForm(CategorySearchType::class,$categorySearch);
      $form->handleRequest($request);

      $produits= [];

      if($form->isSubmitted() && $form->isValid()) {
        $category = $categorySearch->getCategory();
       
        if ($category!="") 
        {
          
          $produits= $category->getProduits();
         // ou bien 
         //$produits= $this->getDoctrine()->getRepository(Article::class)->findBy(['category' => $category] );
        }
        else   
        $produits= $this->getDoctrine()->getRepository(Produit::class)->findAll();
        }
      
      return $this->render('produit/produit_par_Cat_clt.html.twig',['form' => $form->createView(),'produits' => $produits]);
  }
}

