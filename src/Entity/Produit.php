<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
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

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Indisponible", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $jourIndisponible;

    /**
     * @ORM\Column(type="integer")
     */
    private $etatProduit;

    /**
     * @ORM\Column(type="text")
     */
    private $messageProduit;

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

    public function getJourIndisponible()
    {
        return $this->jourIndisponible;
    }

    public function setJourIndisponible(jourIndisponible $jourIndisponible): self
    {
        $this->jourIndisponible = $jourIndisponible;

        return $this;
    }

    public function getEtatProduit(): ?int
    {
        return $this->etatProduit;
    }

    public function setEtatProduit(int $etatProduit): self
    {
        $this->etatProduit = $etatProduit;

        return $this;
    }

    public function getMessageProduit(): ?string
    {
        return $this->messageProduit;
    }

    public function setMessageProduit(string $messageProduit): self
    {
        $this->messageProduit = $messageProduit;

        return $this;
    }
}
