<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieSalleRepository")
 */
class CategorieSalle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelleCategorieSalle;

    public function getId()
    {
        return $this->id;
    }

    public function getLibelleCategorieSalle(): ?string
    {
        return $this->libelleCategorieSalle;
    }

    public function setLibelleCategorieSalle(string $libelleCategorieSalle): self
    {
        $this->libelleCategorieSalle = $libelleCategorieSalle;

        return $this;
    }
}
