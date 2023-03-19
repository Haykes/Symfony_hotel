<?php

namespace App\Entity;

use App\Repository\EstablishmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstablishmentRepository::class)]
class Establishment
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: "integer")]
    private $id;
        
        
    #[ORM\Column(type:"string", length:190)]
    private $name;
        
    #[ORM\Column(type:"string",length:190)]
    private $city;
        
    #[ORM\Column(type:"string",length:190)]
    private $adress;
    
    #[ORM\Column(type:"text")]
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
        
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }
        
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }
        
    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
        
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
