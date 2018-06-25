<?php
namespace App\Controller;
//src/Controller/SecurityController

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//sécurité
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
//pour utiliser les annotations
use Symfony\Component\Routing\Annotation\Route;

// table utilisateurs pour enregistrer un nouvel utilisateur
use App\Entity\Membre;

// table Produit pour enregistrer une nouvelle reservation
use App\Entity\Produit;

// table Salle pour récupérer l'id de la salle
use App\Entity\Salle;

// pour le formulaire de reservation, aller charger la table Indisponible pour rentrer les lignes de reservation
use App\Entity\Indisponible;


//formulaire inscription
use App\Form\MembreType;

//formulaire reservation
use App\Form\ReservationType;

//formulaire pour proposer une salle
use App\Form\OffreSalleType;

//gerrer upload photo profil
use App\Services\UploadPhotoMembre;

class SecurityController extends Controller
{
	/* Inscription d'un utilisateur
	affiche le formulaire et ajoute l'utilisateur dans la table user 
	*/
    
	/**
	* @Route(
	*	  "/inscription",
	*	  name="inscription")
	*/
	public function inscription(Request $request, UserPasswordEncoderInterface $passwordEncoder, UploadPhotoMembre $fileUploader)
	{
		//liaison avec la table des utilisateurs
		$membre = new Membre();
		//création du formulaire
		$form = $this->createForm(MembreType::class, $membre);

		//récupération des données du formulaire
		$form->handleRequest($request);
        
		//si soumis et validé
		if($form->isSubmitted() && $form->isValid())
		{
            //on recupere les information du formulaire
            /*$membre = $form->getData();*/ //??????????????????????????hnadleRequest?????
            
            // Upload photo //////////////////////////////////////
            
            $photoProfil = $membre->getPhotoMembre();
            $fileName = $fileUploader->upload($photoProfil);
            $membre->setPhotoMembre($fileName);

            ////Fin de uploadphoto/////////////////////////////////////////////////////
            
            //le siret n'est pas obligatoirement rempli dans mon formulaire d'inscription. 
            //Donc j'applique une contrainte ici si il est rempli            
            /*if(strlen($form->getSiretMembre()) > 0 && strlen($form->getSiretMembre()) =! 14)
            {
                return "Le Numéro Siret doir comporter 14 chiffres";
                //attention !!! ce code n'est pas sur...
            }*/
            
            //enregistrer la date du jour au format SQL pour enregistrer dans la table
            $dateEnregistrement = new \DateTime(); 
            $membre->setDateEnregistrementMembre($dateEnregistrement);
            
            //enregistrer en automatique des infos, c'est fictif, pour ne pas faire planter la requete sql
            $infosCarteBancaire = 'CB'; 
            $membre->setInfoBancaireMembre($infosCarteBancaire);
            
            
			//encodage du mot de passe
			$hash = $passwordEncoder->encodePassword($membre, $membre->getPasswordMembre());
			$membre->setPasswordMembre($hash);
            
            
			//enregistrement dans la table
			$em = $this->getDoctrine()->getManager();
			$em->persist($membre);
			$em->flush();
            
            
            

			//retour à l'accueil
			return $this->redirectToRoute('connexion');
		}
		//affichage du formulaire
		return $this->render('security/inscription.html.twig',
									array('form' => $form->createView(),
												'title' => 'inscription'));
	}
    
    /*POUR LA PHOTO DE PROFIL*/
    
    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

	/**
	* @Route(
	*		"/connexion",
	*	  name="connexion")
	*/
	public function connexion(Request $request, AuthenticationUtils $authUtils)
	{
		//récupération de l'erreur si besoin
		$error = $authUtils->getLastAuthenticationError();
		//dernier username saisi
		$lastUsername = $authUtils->getLastUsername();

		//affichage du formulaire
		return $this->render('security/connexion.html.twig',
							array('last_username' => $lastUsername,
										'error' => $error,
										'title' => 'connexion'));
	}
    
    
    /**
	* @Route(
	*	  "/reservation/{id}",
	*	  name="reservation",
    *     requirements={"id":"\d+"})
	*/
	public function reservation($id, Request $request)
	{
        //pour afficher la description du produit en rappel au dessus du formulaire
        $salle = $this->getDoctrine()->getRepository(Salle::class);
        //infos de la salle (SELECT * FROM salle WHERE id= :id)
        $detailSalle = $salle->find($id);
        
        //Creation d'un nouveau Produit issu de la classe Produit
		$reservation = new Indisponible();
		//création du formulaire
		$form = $this->createForm(ReservationType::class, $reservation);

		//récupération des données du formulaire
		$form->handleRequest($request);
        
        //dans cette fonction, nous allons faire des requete simplifier (sans boucle pour gerer entre jour Depart et jour Arrivée). Pour voir le code qui a commencé à etre developper ->testReservationController.php

        
		//si soumis et validé
		if($form->isSubmitted() && $form->isValid())
		{            
            
            //recuperer l'id membre via la session            
            $idMembre = $this->getUser();
            //ensuite il faut inscrire cet id dans le champs idMembre de la Table Produit
            $reservation->setIdMembre($idMembre);
            
            //insertion de l'id salle dans le champ idSalle de la table Produit
            $reservation->setIdSalle($detailSalle);
            
            //insertion de l'etatProduit dans le champ EtatProduit de la table Produit
            $statutIndisponible = 1; //1 = "loué" et '2' = "indisponible(proprietaire)";
            $reservation->setStatutIndisponible($statutIndisponible);
            
            
            
			//enregistrement dans la table
			$em = $this->getDoctrine()->getManager();
			$em->persist($reservation);
			$em->flush();

			//retour au tableau de bord pour voir notre reservation
			return $this->redirectToRoute('tableauDeBord');
		}
		//affichage du formulaire
		return $this->render('security/reservation.html.twig',
									array('form' => $form->createView(),
												'title' => 'reservation', 'detailSalle'=> $detailSalle));
		
	}
    
    /**
	* @Route(
	*	  "/offreSalle",
	*	  name="offreSalle")
	*/
	public function offreSalle(Request $request)
	{
		//liaison avec la table des utilisateurs
		$nouvelleSalle = new Salle();
		//création du formulaire
		$form = $this->createForm(OffreSalleType::class, $nouvelleSalle);
        
		//récupération des données du formulaire
		$form->handleRequest($request);
        
		//si soumis et validé
		if($form->isSubmitted() && $form->isValid())
		{
            //recuperer l'id membre via la session pour le mettre en BDD
            //Pour recuperer l'id lui donner le lien de la table suffit, on ne lui donne pas le champ à aller chercher. Le manyToOne se fait tout seul.
            $idMembre = $this->getUser();
            $nouvelleSalle->setIdMembre($idMembre);
            
            //recuperer le nom de la salle pour generer une reference unique en incluant son nom
            $nomSalle = $nouvelleSalle->getNomSalle();
            
            //creation d'une reference en automatique
            $referenceUnique = $nomSalle . rand(1,10000);
            $nouvelleSalle->setReferenceSalle($referenceUnique);
            
			//enregistrement dans la table
			$em = $this->getDoctrine()->getManager();
			$em->persist($nouvelleSalle);
			$em->flush();
            
			//retour au tableau de bord pour voir notre reservation
			return $this->redirectToRoute('tableauDeBord');
		}
		//affichage du formulaire
		return $this->render('security/offreSalle.html.twig',
									array('form' => $form->createView(),
												'title' => 'offreSalle'));
	}
}