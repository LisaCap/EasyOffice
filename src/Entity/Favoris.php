<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FavorisRepository")
 */
class Favoris
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idMembre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Salle", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idSalle;

    public function getId()
    {
        return $this->id;
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

    public function getIdSalle()
    {
        return $this->idSalle;
    }

    public function setIdSalle(id $id): self
    {
        $this->idSalle = $id;

        return $this;
    }
}
