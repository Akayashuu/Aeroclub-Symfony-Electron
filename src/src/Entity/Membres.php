<?php

namespace App\Entity;

use App\Repository\MembresRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembresRepository::class)]
class Membres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numMembres = null;

    #[ORM\Column(length: 20)]
    private ?string $nom = null;

    #[ORM\Column(length: 20)]
    private ?string $prenom = null;

    #[ORM\Column(length: 200)]
    private ?string $adresse = null;

    #[ORM\Column(length: 6)]
    private ?string $codePostal = null;

    #[ORM\Column(length: 30)]
    private ?string $ville = null;

    #[ORM\Column(length: 20)]
    private ?string $tel = null;

    #[ORM\Column(length: 20)]
    private ?string $fax = null;

    #[ORM\Column(length: 20)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $numBadge = null;

    #[ORM\Column]
    private ?int $numQualif = null;

    #[ORM\Column(length: 20)]
    private ?string $profession = null;

    #[ORM\Column(length: 20)]
    private ?string $lieuNaissance = null;

    #[ORM\Column(length: 20)]
    private ?string $carteFederal = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateAttestation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateTheoriqueBB = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateTheoriquePPLA = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateBB = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datePPLA = null;

    #[ORM\Column(length: 30)]
    private ?string $numeroBB = null;

    #[ORM\Column(length: 30)]
    private ?string $numeroPPLA = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\Column(length: 200)]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNumBadge(): ?int
    {
        return $this->numBadge;
    }

    public function setNumBadge(int $numBadge): self
    {
        $this->numBadge = $numBadge;

        return $this;
    }

    public function getNumQualif(): ?int
    {
        return $this->numQualif;
    }

    public function setNumQualif(int $numQualif): self
    {
        $this->numQualif = $numQualif;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getCarteFederal(): ?string
    {
        return $this->carteFederal;
    }

    public function setCarteFederal(string $carteFederal): self
    {
        $this->carteFederal = $carteFederal;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getDateAttestation(): ?\DateTimeInterface
    {
        return $this->dateAttestation;
    }

    public function setDateAttestation(\DateTimeInterface $dateAttestation): self
    {
        $this->dateAttestation = $dateAttestation;

        return $this;
    }

    public function getDateTheoriqueBB(): ?\DateTimeInterface
    {
        return $this->dateTheoriqueBB;
    }

    public function setDateTheoriqueBB(\DateTimeInterface $dateTheoriqueBB): self
    {
        $this->dateTheoriqueBB = $dateTheoriqueBB;

        return $this;
    }

    public function getDateTheoriquePPLA(): ?\DateTimeInterface
    {
        return $this->dateTheoriquePPLA;
    }

    public function setDateTheoriquePPLA(\DateTimeInterface $dateTheoriquePPLA): self
    {
        $this->dateTheoriquePPLA = $dateTheoriquePPLA;

        return $this;
    }

    public function getDateBB(): ?\DateTimeInterface
    {
        return $this->dateBB;
    }

    public function setDateBB(\DateTimeInterface $dateBB): self
    {
        $this->dateBB = $dateBB;

        return $this;
    }

    public function getDatePPLA(): ?\DateTimeInterface
    {
        return $this->datePPLA;
    }

    public function setDatePPLA(\DateTimeInterface $datePPLA): self
    {
        $this->datePPLA = $datePPLA;

        return $this;
    }

    public function getNumeroBB(): ?string
    {
        return $this->numeroBB;
    }

    public function setNumeroBB(string $numeroBB): self
    {
        $this->numeroBB = $numeroBB;

        return $this;
    }

    public function getNumeroPPLA(): ?string
    {
        return $this->numeroPPLA;
    }

    public function setNumeroPPLA(string $numeroPPLA): self
    {
        $this->numeroPPLA = $numeroPPLA;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
