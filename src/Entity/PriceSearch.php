<?php 
namespace App\Entity;
class PriceSearch
{
   
     private $minPrice;
    
     /**
      * @var int null
      */
      private $maxPrice;

      public function getMinPrice(): ?int 
      {
          return $this->minPrice;
      }
      public function setMinPrice(int $minPrice): ?int//self
      {
        return  $this->minPrice = $minPrice;

        // return $this->minPrice;
      }

      public function getMaxPrice(): ?int 
      {
          return $this->maxPrice;
      }
      public function setMaxPrice(int $maxPrice): ?int//self
      {
          return $this->maxPrice=$maxPrice;
        //  return $this;
      }
}