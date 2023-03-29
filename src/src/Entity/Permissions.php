<?php

namespace App\Entity;

use App\Repository\PermissionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PermissionsRepository::class)]
class Permissions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "numMembres")]
    private ?int $numMembres = null;

    #[ORM\Column]
    private ?bool $IsAdmin = null;

    public function getNumMembres(): ?int
    {
        return $this->numMembres;
    }

    public function setNumMembres(int $numMembres): self
    {
        $this->numMembres = $numMembres;

        return $this;
    }

    public function isIsAdmin(): ?bool
    {
        return $this->IsAdmin;
    }

    public function setIsAdmin(bool $IsAdmin): self
    {
        $this->IsAdmin = $IsAdmin;

        return $this;
    }
}
