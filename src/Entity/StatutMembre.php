<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatutMembreRepository")
 */
class StatutMembre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libelleStatutMembre;

    public function getId()
    {
        return $this->id;
    }

    public function getLibelleStatutMembre(): ?string
    {
        return $this->libelleStatutMembre;
    }

    public function setLibelleStatutMembre(string $libelleStatutMembre): self
    {
        $this->libelleStatutMembre = $libelleStatutMembre;

        return $this;
    }
}
