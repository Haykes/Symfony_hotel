<?php

namespace App\Entity;

use App\Repository\SuiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuiteRepository::class)]
class Suite
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: "integer")]

    private $id;
    #[ORM\Column(type:"string", length:190)]
    private $title;
    #[ORM\Column(type:"string", length:190)]
    private $image;
    #[ORM\Column(type:"text")]
    private $description;
    #[ORM\Column(type:"float")]
    private $price;

    #[ORM\ManyToOne(targetEntity:"App\Entity\Establishment", inversedBy:"suites")]
    #[ORM\JoinColumn(name:"establishment_id", referencedColumnName:"id")]
    private $establishment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }
    public function setImage(string $image): self
    {
        $this->image = $image;
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

    public function getPrice(): ?float
    {
        return $this->price;
    }
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getEstablishment(): ?Establishment
    {
        return $this->establishment;
    }
    public function setEstablishment(?Establishment $establishment): self
    {
        $this->establishment = $establishment;
        return $this;
    }

}
