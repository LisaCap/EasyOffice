<?php
namespace App\Controller;
//src/Controller/SessionController

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//pour utiliser les annotations
use Symfony\Component\Routing\Annotation\Route;

// pour utiliser la session
use Symfony\Component\HttpFoundation\Session\SessionInterface;


// table Salle
use App\Entity\Salle;

// pour le formulaire prédéfinit dans SearchAccueilType.php
use App\Form\SearchAccueilType;


class SessionController extends Controller
{




	/**
	* @Route(
	* 	"/testSession",
	* 	name="testSession")
	*/

	public function testSession(SessionInterface $session)
	{
		$session->set('toto', 1);

		$test = $session->get('toto');

		return new Response('test ' . $test . ' fuck off');
	}
}