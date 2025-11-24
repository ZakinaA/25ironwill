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
    private ?string $libelle = null;

    #[ORM\Column]
    private ?int $quotientMin = null;

    #[ORM\Column]
    private ?int $quotientMax = null;

    #[ORM\OneToMany(targetEntity: TarifCours::class, mappedBy: 'tranche_quotient_id')]
    private Collection $tarifCours;

    #[ORM\OneToMany(targetEntity: Paiment::class, mappedBy: 'quotient')]
    private Collection $paiments;

    #[ORM\OneToMany(targetEntity: Responsable::class, mappedBy: 'quotient')]
    private Collection $responsables;

    public function __construct()
    {
        $this->tarifCours = new ArrayCollection();
        $this->paiments = new ArrayCollection();
        $this->responsables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    // --- MODIFICATION ICI ---
    // Renommé "getNomTranche" en "getLibelle"
    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    // Renommé "setNomTranche" en "setLibelle"
    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }
    // --- FIN MODIFICATION ---

    public function getQuotientMin(): ?int
    {
        return $this->quotientMin;
    }

    public function setQuotientMin(int $quotientMin): static
    {
        $this->quotientMin = $quotientMin;

        return $this;
    }

    public function getQuotientMax(): ?int
    {
        return $this->quotientMax;
    }

    public function setQuotientMax(int $quotientMax): static
    {
        $this->quotientMax = $quotientMax;

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

    /**
     * @return Collection<int, Responsable>
     */
    public function getResponsables(): Collection
    {
        return $this->responsables;
    }

    public function addResponsable(Responsable $responsable): static
    {
        if (!$this->responsables->contains($responsable)) {
            $this->responsables->add($responsable);
            $responsable->setQuotient($this);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): static
    {
        if ($this->responsables->removeElement($responsable)) {
            // set the owning side to null (unless already changed)
            if ($responsable->getQuotient() === $this) {
                $responsable->setQuotient(null);
            }
        }

        return $this;
    }

    public function getNomTranche(): ?string
{
    return $this->nomTranche;
}

public function setNomTranche(string $nomTranche): static
{
    $this->nomTranche = $nomTranche;

    return $this;
}
}