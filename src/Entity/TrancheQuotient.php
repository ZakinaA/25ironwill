<?php

namespace App\Entity;

use App\Repository\TrancheQuotientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrancheQuotientRepository::class)]
class TrancheQuotient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_tranche = null;

    #[ORM\Column]
    private ?int $quotient_min = null;

    #[ORM\Column]
    private ?int $quotient_max = null;

    #[ORM\OneToMany(targetEntity: TarifCours::class, mappedBy: 'tranche_quotient_id')]
    private Collection $tarifCours;

    #[ORM\OneToMany(targetEntity: Paiment::class, mappedBy: 'quotient')]
    private Collection $paiments;

    public function __construct()
    {
        $this->tarifCours = new ArrayCollection();
        $this->paiments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTranche(): ?string
    {
        return $this->nom_tranche;
    }

    public function setNomTranche(string $nom_tranche): static
    {
        $this->nom_tranche = $nom_tranche;

        return $this;
    }

    public function getQuotientMin(): ?int
    {
        return $this->quotient_min;
    }

    public function setQuotientMin(int $quotient_min): static
    {
        $this->quotient_min = $quotient_min;

        return $this;
    }

    public function getQuotientMax(): ?int
    {
        return $this->quotient_max;
    }

    public function setQuotientMax(int $quotient_max): static
    {
        $this->quotient_max = $quotient_max;

        return $this;
    }

    /**
     * @return Collection<int, TarifCours>
     */
    public function getTarifCours(): Collection
    {
        return $this->tarifCours;
    }

    public function addTarifCour(TarifCours $tarifCour): static
    {
        if (!$this->tarifCours->contains($tarifCour)) {
            $this->tarifCours->add($tarifCour);
            $tarifCour->setTrancheQuotientId($this);
        }

        return $this;
    }

    public function removeTarifCour(TarifCours $tarifCour): static
    {
        if ($this->tarifCours->removeElement($tarifCour)) {
            // set the owning side to null (unless already changed)
            if ($tarifCour->getTrancheQuotientId() === $this) {
                $tarifCour->setTrancheQuotientId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Paiment>
     */
    public function getPaiments(): Collection
    {
        return $this->paiments;
    }

    public function addPaiment(Paiment $paiment): static
    {
        if (!$this->paiments->contains($paiment)) {
            $this->paiments->add($paiment);
            $paiment->setQuotient($this);
        }

        return $this;
    }

    public function removePaiment(Paiment $paiment): static
    {
        if ($this->paiments->removeElement($paiment)) {
            // set the owning side to null (unless already changed)
            if ($paiment->getQuotient() === $this) {
                $paiment->setQuotient(null);
            }
        }

        return $this;
    }
}
