<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EleveRepository::class)]
class Eleve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nom = null;

    #[ORM\Column(length: 30)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $numRue = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $rue = null;

    #[ORM\Column]
    private ?int $copos = null;

    #[ORM\Column(length: 30)]
    private ?string $ville = null;

    #[ORM\Column]
    private ?int $tel = null;

    #[ORM\Column(length: 40)]
    private ?string $mail = null;

    #[ORM\OneToMany(targetEntity: ContratPret::class, mappedBy: 'eleve')]
    private Collection $contratPrets;

    #[ORM\ManyToMany(targetEntity: Responsable::class, mappedBy: 'eleve')]
    private Collection $responsables;

    #[ORM\OneToMany(targetEntity: Inscription::class, mappedBy: 'eleve')]
    private Collection $inscriptions;

    /* --- AJOUT ICI : La propriété pour les paiements --- */
    #[ORM\OneToMany(targetEntity: Paiment::class, mappedBy: 'eleve')]
    private Collection $paiments;
    /* -------------------------------------------------- */

    #[ORM\OneToOne(targetEntity: User::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getUser(): ?User { return $this->user; }
    public function setUser(User $user): self { $this->user = $user; return $this; }

    public function __construct()
    {
        $this->contratPrets = new ArrayCollection();
        $this->responsables = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
        
        /* --- AJOUT ICI : Initialisation de la collection --- */
        $this->paiments = new ArrayCollection();
        /* --------------------------------------------------- */
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumRue(): ?int
    {
        return $this->numRue;
    }

    public function setNumRue(int $numRue): static
    {
        $this->numRue = $numRue;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): static
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCopos(): ?int
    {
        return $this->copos;
    }

    public function setCopos(int $copos): static
    {
        $this->copos = $copos;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection<int, ContratPret>
     */
    public function getContratPrets(): Collection
    {
        return $this->contratPrets;
    }

    public function addContratPret(ContratPret $contratPret): static
    {
        if (!$this->contratPrets->contains($contratPret)) {
            $this->contratPrets->add($contratPret);
            $contratPret->setEleve($this);
        }

        return $this;
    }

    public function removeContratPret(ContratPret $contratPret): static
    {
        if ($this->contratPrets->removeElement($contratPret)) {
            // set the owning side to null (unless already changed)
            if ($contratPret->getEleve() === $this) {
                $contratPret->setEleve(null);
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
            $responsable->addEleve($this);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): static
    {
        if ($this->responsables->removeElement($responsable)) {
            $responsable->removeEleve($this);
        }

        return $this;
    }


    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setEleve($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getEleve() === $this) {
                $inscription->setEleve(null);
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

}