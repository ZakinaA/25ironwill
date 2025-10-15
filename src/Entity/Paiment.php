<?php

namespace App\Entity;

use App\Repository\PaimentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaimentRepository::class)]
class Paiment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datePaiment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDatePaiment(): ?\DateTimeInterface
    {
        return $this->datePaiment;
    }

    public function setDatePaiment(\DateTimeInterface $datePaiment): static
    {
        $this->datePaiment = $datePaiment;

        return $this;
    }
}
