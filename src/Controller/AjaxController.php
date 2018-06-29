<?php
namespace App\Controller;
//src/Controller/PublicController.php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
//annotations pour les routes
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//pour les catégories
use App\Entity\Indisponible;
//pour les membres
use App\Entity\Membre;

// table Salle pour récupérer l'id de la salle
use App\Entity\Salle;

//pour le calendrier statique
use App\Services\Calendrier;

//pour le calendrier ajout
use App\Services\CalendrierAjout;

class AjaxController extends Controller
{
	/**
	 * @Route("/suppPanier", name="suppPanier")
	 */
	public function suppPanier(Request $request)
	{
		$id = $request->get('id');
		$panier = $this->getDoctrine()->getRepository(Panier::class);
		$lignePanier = $panier->find($id);
		//Entity Manager
		$em = $this->getDoctrine()->getManager();
		$em->remove($lignePanier);
		$em->flush();
		return new Response(json_encode(['msg' => '<p class="alert alert-success">élément supprimé</p>']));
	} 

	/**
	 * @Route("/modifPanier", name="modifPanier")
	 */
	public function modifPanier(Request $request)
	{
		$id = $request->get('id');
		$value = $request->get('value');
		$em = $this->getDoctrine()->getManager();
		$panier = $em->getRepository(Panier::class)->find($id);
		//Entity Manager
		$panier->setQuantiteProduit($value);
		$em->flush();

		return new response(json_encode(['msg' => '<p class="alert alert-success">Quantité modifiée</p>']));
	}

	/**
	 * @Route("/recupAdr", name="recupAdr")
	 */
	public function recupAdr()
	{
		$retour = array();
		$em = $this->getDoctrine()->getManager();
		$adresses = $em->getRepository(Clients::class)->findAll();
		foreach($adresses as $adr)
		{
			$retour[] = ['adr' =>$adr->getAdresseClient().' '
													.$adr->getCpClient().' '
													.$adr->getVilleClient(), 
									 'nom' => $adr->getPrenomClient().' '
									 				 .$adr->getNomClient()];
		}
		return new Response(json_encode($retour));
	}
    
    /**
	* @Route(
	*	  "/reservation/{id}",
	*	  name="reservation",
    *     requirements={"id":"\d+"})
	*/
	public function reservation($id, Request $request, CalendrierAjout $calendrierAjout)
	{
        //pour afficher la description du produit en rappel au dessus du formulaire
        $salle = $this->getDoctrine()->getRepository(Salle::class);
        //infos de la salle (SELECT * FROM salle WHERE id= :id)
        $detailSalle = $salle->find($id);
        
        //on appelle notre service qui va afficher le calendrier et qui est lié au IndisponibleRepository
        $calendrier_indisponible = $this->getDoctrine()->getRepository(Indisponible::class);
        $affichageCalendrier = $calendrierAjout->creationCalendrier($id, $calendrier_indisponible);

		//affichage du formulaire
		return $this->render('public/reservation.html.twig',
									array('affichage_calendrier' => $affichageCalendrier,'title' => 'reservation', 'detailSalle'=> $detailSalle, 'id' => $detailSalle->getId()));
		
	}
    
    /**
	* @Route(
	*	  "/ajoutReservation/{date}",
	*	  name="ajoutReservation")
	*/
	public function ajoutReservation($date, Request $request)
	{
        //pour creer une nouvelle reservation, on creer un nouvel objet
        $reservation = new Indisponible();
        
            //GETTERS
            //recuperer l'id membre via la session            
            $idMembre = $this->getUser();
            //recuperer la valeur du jour via la value inserer dans le tableau
            $idSalle = $request->get('id_salle');
            //SETTERS
            //On insere l'id membre
            $reservation->setIdMembre($idMembre);
            //on insere l'id salle
            $reservation->setIdSalle($idSalle);
            //1 = "loué" et '2' = "indisponible(proprietaire)";
            $statutIndisponible = 1;
            $reservation->setStatutIndisponible($statutIndisponible);
            //setter pour le jour
            //$dateBonFormat =  $date->format('Y-m-d');
            
            //$dateOk = date('Y-m-d', strtotime($date));
            $dateOk = new \DateTime($date);
            //dump($dateBonFormat);
            $reservation->setJourIndisponible($dateOk);
        
        
        //enregistrement dans la table
        $em = $this->getDoctrine()->getManager();
        $em->persist($reservation);
        $em->flush();

		return new response(json_encode(['msg' => '<p class="alert alert-success">Jour reservé !</p>']));
		
	}

}