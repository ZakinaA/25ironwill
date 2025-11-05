<?php

namespace App\Entity;

use App\Repository\TarifCoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TarifCoursRepository::class)]
class TarifCours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tarifCours')]
    private ?TrancheQuotient $tranche_quotient_id = null;

    #[ORM\ManyToOne(inversedBy: 'tarifCours')]
    private ?Type $cours_id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: '0')]
    private ?string $prix_facture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrancheQuotientId(): ?TrancheQuotient
    {
        return $this->tranche_quotient_id;
    }

    public function setTrancheQuotientId(?TrancheQuotient $tranche_quotient_id): static
    {
        $this->tranche_quotient_id = $tranche_quotient_id;

        return $this;
    }

    public function getCoursId(): ?Type
    {
        return $this->cours_id;
    }

    public function setCoursId(?Type $cours_id): static
    {
        $this->cours_id = $cours_id;

        return $this;
    }

    public function getPrixFacture(): ?string
    {
        return $this->prix_facture;
    }

    public function setPrixFacture(string $prix_facture): static
    {
        $this->prix_facture = $prix_facture;

        return $this;
    }
}
