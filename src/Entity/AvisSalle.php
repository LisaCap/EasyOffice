<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvisSalleRepository")
 */
class AvisSalle
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
     * @ORM\Column(type="integer")
     */
    private $noteSalle;

    /**
     * @ORM\Column(type="text")
     */
    private $commentaireSalle;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCommentaireSalle;

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

    public function getNoteSalle(): ?int
    {
        return $this->noteSalle;
    }

    public function setNoteSalle(int $noteSalle): self
    {
        $this->noteSalle = $noteSalle;

        return $this;
    }

    public function getCommentaireSalle(): ?string
    {
        return $this->commentaireSalle;
    }

    public function setCommentaireSalle(string $commentaireSalle): self
    {
        $this->commentaireSalle = $commentaireSalle;

        return $this;
    }

    public function getDateCommentaireSalle(): ?\DateTimeInterface
    {
        return $this->dateCommentaireSalle;
    }

    public function setDateCommentaireSalle(\DateTimeInterface $dateCommentaireSalle): self
    {
        $this->dateCommentaireSalle = $dateCommentaireSalle;

        return $this;
    }
}
