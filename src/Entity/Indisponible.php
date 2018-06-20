<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IndisponibleRepository")
 */
class Indisponible
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Salle", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idSalle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idMembre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $jourIndisponible;

    /**
     * @ORM\Column(type="integer")
     */
    private $statutIndisponible;

    public function getId()
    {
        return $this->id;
    }

    public function getIdSalle()
    {
        return $this->idSalle;
    }

    public function setIdSalle(id $id): self
    {
        $this->idSalle = $id;

        return $this;
    }

    public function getIdMembre()
    {
        return $this->idMembre;
    }

    public function setIdMembre(id $id): self
    {
        $this->idMembre = $id;

        return $this;
    }

    public function getJourIndisponible(): ?\DateTimeInterface
    {
        return $this->jourIndisponible;
    }

    public function setJourIndisponible(\DateTimeInterface $jourIndisponible): self
    {
        $this->jourIndisponible = $jourIndisponible;

        return $this;
    }

    public function getStatutIndisponible(): ?int
    {
        return $this->statutIndisponible;
    }

    public function setStatutIndisponible(int $statutIndisponible): self
    {
        $this->statutIndisponible = $statutIndisponible;

        return $this;
    }
}
