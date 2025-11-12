<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nom = null;

    #[ORM\OneToMany(targetEntity: Tarif::class, mappedBy: 'type')]
    private Collection $tarifs;

    #[ORM\OneToMany(targetEntity: Cours::class, mappedBy: 'type')]
    private Collection $cours;

    #[ORM\OneToMany(targetEntity: TarifCours::class, mappedBy: 'cours_id')]
    private Collection $tarifCours;

    public function __construct()
    {
        $this->tarifs = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->tarifCours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Tarif>
     */
    public function getTarifs(): Collection
    {
        return $this->tarifs;
    }

    public function addTarif(Tarif $tarif): static
    {
        if (!$this->tarifs->contains($tarif)) {
            $this->tarifs->add($tarif);
            $tarif->setType($this);
        }

        return $this;
    }

    public function removeTarif(Tarif $tarif): static
    {
        if ($this->tarifs->removeElement($tarif)) {
            // set the owning side to null (unless already changed)
            if ($tarif->getType() === $this) {
                $tarif->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): static
    {
        if (!$this->cours->contains($cour)) {
            $this->cours->add($cour);
            $cour->setType($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getType() === $this) {
                $cour->setType(null);
            }
        }

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
            $tarifCour->setCoursId($this);
        }

        return $this;
    }

    public function removeTarifCour(TarifCours $tarifCour): static
    {
        if ($this->tarifCours->removeElement($tarifCour)) {
            // set the owning side to null (unless already changed)
            if ($tarifCour->getCoursId() === $this) {
                $tarifCour->setCoursId(null);
            }
        }

        return $this;
    }
}
