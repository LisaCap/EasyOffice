<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembreRepository")
 */


class Membre implements UserInterface, \Serializable
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
    private $nomMembre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomMembre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomDeSocieteMembre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siretMembre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tvaMembre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDeNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexeMembre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseMembre;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $cpMembre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeMembre;

    /**
     * @ORM\Column(type="string", length=13)
     */
    private $telephoneMembre;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\StatutMembre", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idStatutMembre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailMembre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $passwordMembre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateEnregistrementMembre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $infoBancaireMembre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photoMembre;
    
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    /**
    * @ORM\Column(type="array")
    */
    private $roles;
    
    // constructeur. Définit le statut actif et ajoute le role ADMIN automatiquement
    public function __construct()
    {
        $this->isActive = true;
        $this->roles[] = 'ROLE_USER';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNomMembre(): ?string
    {
        return $this->nomMembre;
    }

    public function setNomMembre(string $nomMembre): self
    {
        $this->nomMembre = $nomMembre;

        return $this;
    }

    public function getPrenomMembre(): ?string
    {
        return $this->prenomMembre;
    }

    public function setPrenomMembre(string $prenomMembre): self
    {
        $this->prenomMembre = $prenomMembre;

        return $this;
    }

    public function getNomDeSocieteMembre(): ?string
    {
        return $this->nomDeSocieteMembre;
    }

    public function setNomDeSocieteMembre(string $nomDeSocieteMembre): self
    {
        $this->nomDeSocieteMembre = $nomDeSocieteMembre;

        return $this;
    }

    public function getSiretMembre(): ?string
    {
        return $this->siretMembre;
    }

    public function setSiretMembre(string $siretMembre): self
    {
        $this->siretMembre = $siretMembre;

        return $this;
    }

    public function getTvaMembre(): ?string
    {
        return $this->tvaMembre;
    }

    public function setTvaMembre(string $tvaMembre): self
    {
        $this->tvaMembre = $tvaMembre;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    public function getSexeMembre(): ?string
    {
        return $this->sexeMembre;
    }

    public function setSexeMembre(string $sexeMembre): self
    {
        $this->sexeMembre = $sexeMembre;

        return $this;
    }

    public function getAdresseMembre(): ?string
    {
        return $this->adresseMembre;
    }

    public function setAdresseMembre(string $adresseMembre): self
    {
        $this->adresseMembre = $adresseMembre;

        return $this;
    }

    public function getCpMembre(): ?string
    {
        return $this->cpMembre;
    }

    public function setCpMembre(string $cpMembre): self
    {
        $this->cpMembre = $cpMembre;

        return $this;
    }

    public function getVilleMembre(): ?string
    {
        return $this->villeMembre;
    }

    public function setVilleMembre(string $villeMembre): self
    {
        $this->villeMembre = $villeMembre;

        return $this;
    }

    public function getTelephoneMembre(): ?string
    {
        return $this->telephoneMembre;
    }

    public function setTelephoneMembre(string $telephoneMembre): self
    {
        $this->telephoneMembre = $telephoneMembre;

        return $this;
    }

    public function getIdStatutMembre()
    {
        return $this->idStatutMembre;
    }

    public function setIdStatutMembre($id): self
    {
        $this->idStatutMembre = $id;

        return $this;
    }

    public function getEmailMembre(): ?string
    {
        return $this->emailMembre;
    }

    public function setEmailMembre(string $emailMembre): self
    {
        $this->emailMembre = $emailMembre;

        return $this;
    }
    
    //GESTION PASSWORD//////////////////////////
    
    //méthode imposée par l'interface
    public function getUsername(): ?string
    {
        return $this->emailMembre;
    }
    // méthode imposée par l'interface
    public function setUsername(string $emailMembre): self
    {
        $this->emailMembre = $emailMembre;
        return $this;
    }
    //méthode imposée par l'interface
    public function getPassword(): ?string
    {
        return $this->passwordMembre;
    }
    public function getPasswordMembre(): ?string
    {
        return $this->passwordMembre;
    }
    //méthode imposée par l'interface
    public function setPassword(string $passwordMembre): self
    {
        $this->passwordMembre = $passwordMembre;
        return $this;
    }
    
    public function setPasswordMembre(string $passwordMembre): self
    {
        $this->passwordMembre = $passwordMembre;

        return $this;
    }
    ////////////////////////////


    public function getDateEnregistrementMembre(): ?\DateTimeInterface
    {
        return $this->dateEnregistrementMembre;
    }

    public function setDateEnregistrementMembre(\DateTimeInterface $dateEnregistrementMembre): self
    {
        $this->dateEnregistrementMembre = $dateEnregistrementMembre;

        return $this;
    }

    public function getInfoBancaireMembre(): ?string
    {
        return $this->infoBancaireMembre;
    }

    public function setInfoBancaireMembre(string $infoBancaireMembre): self
    {
        $this->infoBancaireMembre = $infoBancaireMembre;

        return $this;
    }

    public function getPhotoMembre()
    {
        return $this->photoMembre;
    }

    public function setPhotoMembre($photoMembre): self
    {
        $this->photoMembre = $photoMembre;

        return $this;
    }
    
    ///Les fonction à rajouter pour Membre //////////////////////
    //récupération des rôles
    public function getRoles()
    {
        return $this->roles; //return ['ROLE_USER'];
    }
    //récupération du "salt" (null car bscript le fait automatiquement)
    public function getSalt()
    {
        return null;
    }
    //fonction imposée par l'interface user
    public function eraseCredentials()
    {
    }
    //sérialisation de l'utilisateur (pour stocker en session)
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->emailMembre,
            $this->passwordMembre,
            $this->isActive
        ));
    }
    //dé-sérialisation de l'objet (session)
    public function unserialize($serialized)
    {
        list($this->id, 
                 $this->emailMembre,
                 $this->passwordMembre,
                 $this->isActive)
        = unserialize($serialized);
    }
    //ajout d'un role
    public function setRoles($val)
    {
        return $this->roles[] = $val;
    }
    //compte non expiré?
    public function isAccountNonExpired()
    {
        return true;
    }
    //Compte non vérouillé
    public function isAccountNonLocked()
    {
        return true;
    }
    //  identifiants non expirés
    public function isCredentialsNonExpired()
    {
        return true;
    }
    // est activé
    public function isEnabled()
    {
        return $this->isActive;
    }
}
