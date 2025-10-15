<?php

namespace App\Entity;

use App\Repository\MetierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetierRepository::class)]
class Metier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\ManyToMany(targetEntity: Professionnel::class, inversedBy: 'metiers')]
    private Collection $professionnel;

    public function __construct()
    {
        $this->professionnel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Professionnel>
     */
    public function getProfessionnel(): Collection
    {
        return $this->professionnel;
    }

    public function addProfessionnel(Professionnel $professionnel): static
    {
        if (!$this->professionnel->contains($professionnel)) {
            $this->professionnel->add($professionnel);
        }

        return $this;
    }

    public function removeProfessionnel(Professionnel $professionnel): static
    {
        $this->professionnel->removeElement($professionnel);

        return $this;
    }
}
