<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: "integer")]
    private $id;

    #[ORM\ManyToOne(targetEntity: Suite::class), ORM\JoinColumn(nullable: false)]
    private $suite;

    #[ORM\Column(type: "datetime")]
    #[Assert\NotBlank(message: "Veuillez choisir une date de début.")]
    #[Assert\GreaterThanOrEqual("today", message: "La date de début doit être égale ou postérieure à aujourd'hui.")]
    private $startDate;

    #[ORM\Column(type: "datetime")]
    #[Assert\NotBlank(message: "Veuillez choisir une date de fin.")]
    #[Assert\GreaterThan(propertyPath: "startDate", message: "La date de fin doit être postérieure à la date de début.")]
    private $endDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSuite(): ?Suite
    {
        return $this->suite;
    }

    public function setSuite(?Suite $suite): self
    {
        $this->suite = $suite;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context, $payload): void
    {
        if ($this->startDate !== null && $this->endDate !== null && $this->startDate >= $this->endDate) {
            $context->buildViolation('La date de fin doit être postérieure à la date de début.')
                ->atPath('endDate')
                ->addViolation();
        }
    }
}
