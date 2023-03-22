<?php

namespace App\Entity;

use App\Repository\ComptesAcRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComptesAcRepository::class)]
class ComptesAc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "numCompte")]
    private ?int $numCompte = null;

    #[ORM\Column(name: "numMembres")]
    private ?int $numMembres = null;

    #[ORM\Column(name: "numSeq")]
    private ?int $numSeq = null;

    #[ORM\Column(length: 200)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?float $debit = null;

    #[ORM\Column]
    private ?float $credit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCompte(): ?int
    {
        return $this->numCompte;
    }

    public function setNumCompte(int $numCompte): self
    {
        $this->numCompte = $numCompte;

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

    public function getNumSeq(): ?int
    {
        return $this->numSeq;
    }

    public function setNumSeq(int $numSeq): self
    {
        $this->numSeq = $numSeq;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getDebit(): ?float
    {
        return $this->debit;
    }

    public function setDebit(float $debit): self
    {
        $this->debit = $debit;

        return $this;
    }

    public function getCredit(): ?float
    {
        return $this->credit;
    }

    public function setCredit(float $credit): self
    {
        $this->credit = $credit;

        return $this;
    }
}
