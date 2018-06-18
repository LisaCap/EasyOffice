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
// table utilisateurs
use App\Entity\Membre;
//formulaire inscription
use App\Form\MembreType;

class SecurityController extends Controller
{
	/* Inscription d'un utilisateur
	affiche le formulaire et ajoute l'utilisateur dans la table user 
	*/
	/**
	* @Route(
	*		"/inscription",
	*	  name="inscription")
	*/
	public function inscription(Request $request, UserPasswordEncoderInterface $passwordEncoder)
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
			//encodage du mot de passe
			$hash = $passwordEncoder->encodePassword($membre, $membre->getPasswordMembre());
			$membre->setPasswordMembre($hash);
			//enregistrement dans la table
			$em = $this->getDoctrine()->getManager();
			$em->persist($membre);
			$em->flush();

			//retour à l'accueil
			return $this->redirectToRoute('index');
		}
		//affichage du formulaire
		return $this->render('security/inscription.html.twig',
									array('form' => $form->createView(),
												'title' => 'inscription'));
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
	*		"/deconnexion",
	*	  name="deconnexion")
	*/
}