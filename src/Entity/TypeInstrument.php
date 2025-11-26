<?php

namespace App\Entity;

use App\Repository\TypeInstrumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeInstrumentRepository::class)]
class TypeInstrument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelle = null;

    #[ORM\OneToMany(targetEntity: Instrument::class, mappedBy: 'type')]
    private Collection $instruments;

    #[ORM\ManyToMany(targetEntity: Professeur::class, mappedBy: 'typeInstrument')]
    private Collection $professeurs;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'typeInstruments')]
    private ?self $classeInstrument = null;

    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'classeInstrument')]
    private Collection $typeInstruments;


    #[ORM\OneToMany(targetEntity: Cours::class, mappedBy: 'typeInstrument')]
    private Collection $cours;

    public function __construct()
    {
        $this->instruments = new ArrayCollection();
        $this->professeurs = new ArrayCollection();
        $this->typeInstruments = new ArrayCollection();
        $this->cours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Instrument>
     */
    public function getInstruments(): Collection
    {
        return $this->instruments;
    }

    public function addInstrument(Instrument $instrument): static
    {
        if (!$this->instruments->contains($instrument)) {
            $this->instruments->add($instrument);
            $instrument->setType($this);
        }

        return $this;
    }

    public function removeInstrument(Instrument $instrument): static
    {
        if ($this->instruments->removeElement($instrument)) {
            // set the owning side to null (unless already changed)
            if ($instrument->getType() === $this) {
                $instrument->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(Professeur $professeur): static
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs->add($professeur);
            $professeur->addTypeInstrument($this);
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): static
    {
        if ($this->professeurs->removeElement($professeur)) {
            $professeur->removeTypeInstrument($this);
        }

        return $this;
    }

    public function getClasseInstrument(): ?self
    {
        return $this->classeInstrument;
    }

    public function setClasseInstrument(?self $classeInstrument): static
    {
        $this->classeInstrument = $classeInstrument;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getTypeInstruments(): Collection
    {
        return $this->typeInstruments;
    }

    public function addTypeInstrument(self $typeInstrument): static
    {
        if (!$this->typeInstruments->contains($typeInstrument)) {
            $this->typeInstruments->add($typeInstrument);
            $typeInstrument->setClasseInstrument($this);
        }

        return $this;
    }

    public function removeTypeInstrument(self $typeInstrument): static
    {
        if ($this->typeInstruments->removeElement($typeInstrument)) {
            // set the owning side to null (unless already changed)
            if ($typeInstrument->getClasseInstrument() === $this) {
                $typeInstrument->setClasseInstrument(null);
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
            $cour->setTypeInstrument($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getTypeInstrument() === $this) {
                $cour->setTypeInstrument(null);
            }
        }

        return $this;
    }
}
