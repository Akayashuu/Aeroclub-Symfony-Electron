<?php

namespace App\Entity;

use App\Repository\SequenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SequenceRepository::class)]
class Sequence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"numSequence")]
    private ?int $numSequence = null;

    #[ORM\Column(name:"numMembres")]
    private ?int $numMembres = null;

    #[ORM\Column(name:"numInstructeur")]
    private ?int $numInstructeur = null;

    #[ORM\Column(name:"numAvions")]
    private ?int $numAvions = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $temps = null;

    #[ORM\Column]
    private ?float $prixSpecial = null;

    #[ORM\Column]
    private ?float $taux = null;

    #[ORM\Column]
    private ?float $reductionSemaine = null;

    #[ORM\Column(name:"numMotif")]
    private ?int $numMotif = null;

    #[ORM\Column]
    private ?float $tauxInstructeur = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $forfaitInitialisation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSequence(): ?int
    {
        return $this->numSequence;
    }

    public function setNumSequence(int $numSequence): self
    {
        $this->numSequence = $numSequence;

        return $this;
    }

    public function getNumMembres(): ?int
    {
        return $this->numMembres;
    }

    public function setNumMembres(int $numMembres): self
    {
        $this->numMembres = $numMembres;

        return $this;
    }

    public function getNumInstructeur(): ?int
    {
        return $this->numInstructeur;
    }

    public function setNumInstructeur(int $numInstructeur): self
    {
        $this->numInstructeur = $numInstructeur;

        return $this;
    }

    public function getNumAvions(): ?int
    {
        return $this->numAvions;
    }

    public function setNumAvions(int $numAvions): self
    {
        $this->numAvions = $numAvions;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTemps(): ?int
    {
        return $this->temps;
    }

    public function setTemps(int $temps): self
    {
        $this->temps = $temps;

        return $this;
    }

    public function getPrixSpecial(): ?float
    {
        return $this->prixSpecial;
    }

    public function setPrixSpecial(float $prixSpecial): self
    {
        $this->prixSpecial = $prixSpecial;

        return $this;
    }

    public function getTaux(): ?float
    {
        return $this->taux;
    }

    public function setTaux(float $taux): self
    {
        $this->taux = $taux;

        return $this;
    }

    public function getReductionSemaine(): ?float
    {
        return $this->reductionSemaine;
    }

    public function setReductionSemaine(float $reductionSemaine): self
    {
        $this->reductionSemaine = $reductionSemaine;

        return $this;
    }

    public function getNumMotif(): ?int
    {
        return $this->numMotif;
    }

    public function setNumMotif(int $numMotif): self
    {
        $this->numMotif = $numMotif;

        return $this;
    }

    public function getTauxInstructeur(): ?float
    {
        return $this->tauxInstructeur;
    }

    public function setTauxInstructeur(float $tauxInstructeur): self
    {
        $this->tauxInstructeur = $tauxInstructeur;

        return $this;
    }

    public function getForfaitInitialisation(): ?int
    {
        return $this->forfaitInitialisation;
    }

    public function setForfaitInitialisation(int $forfaitInitialisation): self
    {
        $this->forfaitInitialisation = $forfaitInitialisation;

        return $this;
    }
}
