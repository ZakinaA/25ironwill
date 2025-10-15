<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\ManyToOne(inversedBy: 'inscription')]
    private ?Cours $cours = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    private ?Eleve $eleve = null;

    #[ORM\OneToMany(targetEntity: Paiment::class, mappedBy: 'inscription')]
    private Collection $paiment;

    public function __construct()
    {
        $this->paiment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): static
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): static
    {
        $this->cours = $cours;

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

    /**
     * @return Collection<int, Paiment>
     */
    public function getPaiment(): Collection
    {
        return $this->paiment;
    }

    public function addPaiment(Paiment $paiment): static
    {
        if (!$this->paiment->contains($paiment)) {
            $this->paiment->add($paiment);
            $paiment->setInscription($this);
        }

        return $this;
    }

    public function removePaiment(Paiment $paiment): static
    {
        if ($this->paiment->removeElement($paiment)) {
            // set the owning side to null (unless already changed)
            if ($paiment->getInscription() === $this) {
                $paiment->setInscription(null);
            }
        }

        return $this;
    }
}
