<?php

namespace App\Entity;

class PropertySearch
{

   private $id;
private $email;
private $password;
private $nomProd;
private $nom;
 
   public function getNomProd(): ?string
   {
       return $this->nomProd;
   }

   public function setNomProd(string $nomProd): self
   {
       $this->nomProd= $nomProd;

       return $this;
   }

   

   
}
