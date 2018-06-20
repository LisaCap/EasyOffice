<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalleRepository")
 */
class Salle
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
     * @ORM\Column(type="string", length=30)
     */
    private $referenceSalle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomSalle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseSalle;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $cpSalle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeSalle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieSalle", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCategorieSalle;

    /**
     * @ORM\Column(type="integer")
     */
    private $surfaceSalle;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionSalle;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrPieceSalle;

    /**
     * @ORM\Column(type="integer")
     */
    private $capaciteSalle;

    /**
     * @ORM\Column(type="integer")
     */
    private $prixSalle;

    /**
     * @ORM\Column(type="integer")
     */
    private $equipementSalle;

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

    public function getReferenceSalle(): ?string
    {
        return $this->referenceSalle;
    }

    public function setReferenceSalle(string $referenceSalle): self
    {
        $this->referenceSalle = $referenceSalle;

        return $this;
    }

    public function getNomSalle(): ?string
    {
        return $this->nomSalle;
    }

    public function setNomSalle(string $nomSalle): self
    {
        $this->nomSalle = $nomSalle;

        return $this;
    }

    public function getAdresseSalle(): ?string
    {
        return $this->adresseSalle;
    }

    public function setAdresseSalle(string $adresseSalle): self
    {
        $this->adresseSalle = $adresseSalle;

        return $this;
    }

    public function getCpSalle(): ?string
    {
        return $this->cpSalle;
    }

    public function setCpSalle(string $cpSalle): self
    {
        $this->cpSalle = $cpSalle;

        return $this;
    }

    public function getVilleSalle(): ?string
    {
        return $this->villeSalle;
    }

    public function setVilleSalle(string $villeSalle): self
    {
        $this->villeSalle = $villeSalle;

        return $this;
    }

    public function getIdCategorieSalle()
    {
        return $this->idCategorieSalle;
    }

    public function setIdCategorieSalle(id $id): self
    {
        $this->idCategorieSalle = $id;

        return $this;
    }

    public function getSurfaceSalle(): ?int
    {
        return $this->surfaceSalle;
    }

    public function setSurfaceSalle(int $surfaceSalle): self
    {
        $this->surfaceSalle = $surfaceSalle;

        return $this;
    }

    public function getDescriptionSalle(): ?string
    {
        return $this->descriptionSalle;
    }

    public function setDescriptionSalle(string $descriptionSalle): self
    {
        $this->descriptionSalle = $descriptionSalle;

        return $this;
    }

    public function getNbrPieceSalle(): ?int
    {
        return $this->nbrPieceSalle;
    }

    public function setNbrPieceSalle(int $nbrPieceSalle): self
    {
        $this->nbrPieceSalle = $nbrPieceSalle;

        return $this;
    }

    public function getCapaciteSalle(): ?int
    {
        return $this->capaciteSalle;
    }

    public function setCapaciteSalle(int $capaciteSalle): self
    {
        $this->capaciteSalle = $capaciteSalle;

        return $this;
    }

    public function getPrixSalle(): ?int
    {
        return $this->prixSalle;
    }

    public function setPrixSalle(int $prixSalle): self
    {
        $this->prixSalle = $prixSalle;

        return $this;
    }

    public function getEquipementSalle(): ?int
    {
        return $this->equipementSalle;
    }

    public function setEquipementSalle(int $equipementSalle): self
    {
        $this->equipementSalle = $equipementSalle;

        return $this;
    }
}
