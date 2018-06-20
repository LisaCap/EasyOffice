<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvisMembreRepository")
 */
class AvisMembre
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
     * @ORM\Column(type="integer")
     */
    private $noteMembre;

    /**
     * @ORM\Column(type="text")
     */
    private $commentaireMembre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCommentaireMembre;

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

    public function getNoteMembre(): ?int
    {
        return $this->noteMembre;
    }

    public function setNoteMembre(int $noteMembre): self
    {
        $this->noteMembre = $noteMembre;

        return $this;
    }

    public function getCommentaireMembre(): ?string
    {
        return $this->commentaireMembre;
    }

    public function setCommentaireMembre(string $commentaireMembre): self
    {
        $this->commentaireMembre = $commentaireMembre;

        return $this;
    }

    public function getDateCommentaireMembre(): ?\DateTimeInterface
    {
        return $this->dateCommentaireMembre;
    }

    public function setDateCommentaireMembre(\DateTimeInterface $dateCommentaireMembre): self
    {
        $this->dateCommentaireMembre = $dateCommentaireMembre;

        return $this;
    }
}
