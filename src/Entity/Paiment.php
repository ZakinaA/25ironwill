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

    #[ORM\ManyToOne(inversedBy: 'paiment')]
    private ?Inscription $inscription = null;

    #[ORM\ManyToOne(inversedBy: 'paiments')]
    private ?Eleve $eleve = null;

    #[ORM\ManyToOne(inversedBy: 'paiments')]
    private ?TrancheQuotient $quotient = null;

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

    public function getInscription(): ?Inscription
    {
        return $this->inscription;
    }

    public function setInscription(?Inscription $inscription): static
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function getEleve(): ?Eleve
    {
        return $this->eleve;
    }

    public function setEleve(?Eleve $eleve): static
    {
        $this->eleve = $eleve;

        return $this;
    }

    public function getQuotient(): ?TrancheQuotient
    {
        return $this->quotient;
    }

    public function setQuotient(?TrancheQuotient $quotient): static
    {
        $this->quotient = $quotient;

        return $this;
    }
}
