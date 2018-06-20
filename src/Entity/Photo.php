<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoRepository")
 */
class Photo
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
     * @ORM\Column(type="string", length=255)
     */
    private $lienPhotoDefault;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lienPhotoDetails;

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

    public function getLienPhotoDefault(): ?string
    {
        return $this->lienPhotoDefault;
    }

    public function setLienPhotoDefault(string $lienPhotoDefault): self
    {
        $this->lienPhotoDefault = $lienPhotoDefault;

        return $this;
    }

    public function getLienPhotoDetails(): ?string
    {
        return $this->lienPhotoDetails;
    }

    public function setLienPhotoDetails(string $lienPhotoDetails): self
    {
        $this->lienPhotoDetails = $lienPhotoDetails;

        return $this;
    }
}
