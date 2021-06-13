<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\Client2Repository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=Client2Repository::class)
 * @UniqueEntity(
 * fields={"email"},
 * message= "L'Email est déjà utilisé"
 * )
 */
class Client2 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)   
 * @Assert\Length(
 * min = 3,
 * max = 50,
 * minMessage = "Le nom d'un article doit comporter au moins {{ limit }}caractères",
 * maxMessage = "Le nom d'un article doit comporter au plus {{ limit }} caractères"
 * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)   
 * @Assert\Length(
 * min = 3,
 * max = 50,
 * minMessage = "Le nom d'un article doit comporter au moins {{ limit }}caractères",
 * maxMessage = "Le nom d'un article doit comporter au plus {{ limit }} caractères"
 * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)   
 * @Assert\Length(
 * min = 5,
 * max = 15,
 * minMessage = "Le nom d'un article doit comporter au moins {{ limit }}caractères",
 * maxMessage = "Le nom d'un article doit comporter au plus {{ limit }} caractères"
 * )
     */
    private $password;
/**
 * @Assert\EqualTo(propertyPath="password")
 */
    public $confirm_password;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
