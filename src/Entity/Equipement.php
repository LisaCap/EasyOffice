<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipementRepository")
 */
class Equipement
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
    private $libelleEquipement;

    public function getId()
    {
        return $this->id;
    }

    public function getLibelleEquipement(): ?string
    {
        return $this->libelleEquipement;
    }

    public function setLibelleEquipement(string $libelleEquipement): self
    {
        $this->libelleEquipement = $libelleEquipement;

        return $this;
    }
}
