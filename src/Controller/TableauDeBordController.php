<?php
//src/Controller/TableauDeBordController.php
namespace App\Controller; //on est dans le dossier src, mais on ecrit App. C'est son nom pour l'appeler (c'est par rapport à l'autolaod)

//creer le lien avec Twig
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// filtrer les admin et les user, avec isGranted
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

use Symfony\Component\HttpFoundation\Response; //retourner une reponse au format HTML

use Symfony\Component\Routing\Annotation\Route; //pour utiliser les annotation installé via le sension/extra-bundle (voir config symphony)
//il y a eu une creation de fichier dans config/routes/annotations.yaml


class TableauDeBordController extends Controller
{
    public function navTableauDeBord(AuthorizationCheckerInterface $authChecker)
    {
        //recuperer le statut membre pour savoir quel menu on lui affiche
        // 1 -> Locataire
        // 2 -> Propriétaire
        // 3 -> Locataire/ Propriétaire
        $statutMembre = $this->getUser()->getIdStatutMembre();
        
        //Faut-il faire une version admin ? ou est ce qu'il herite du user ? 
        
        //si l'utilisateur est loggué et possede les droits ROLE_USER et est locataire
        if($authChecker->isGranted('ROLE_USER') && $statutMembre == '1')
        {
            $liensTableauDeBord = array(
                array('href' => 'tableauDeBord/profil', 'libelle_lien' => 'Profil'),
                array('href' => 'tableauDeBord/mesReservations', 'libelle_lien' => 'Mes reservations'),
                array('href' => 'tableauDeBord/message', 'libelle_lien' => 'Message'));
        }
        
        //si l'utilisateur est loggué et possede les droits ROLE_USER et est propriétaire
        elseif($authChecker->isGranted('ROLE_USER') && $statutMembre == '2')
        {
            $liensTableauDeBord = array(
                array('href' => 'tableauDeBord/profil', 'libelle_lien' => 'Profil'),
                array('href' => 'tableauDeBord/mesReservations', 'libelle_lien' => 'Mes reservations'));
        }
        //pour les autres
        else
        {
            $liensTableauDeBord = array(
                array('href' => 'tableauDeBord/profil', 'libelle_lien' => 'Profil'),
                array('href' => 'tableauDeBord/mesReservations', 'libelle_lien' => 'Mes reservations'),
                array('href' => 'tableauDeBord/test', 'libelle_lien' => 'raté'));
        }
        
        return $this->render('inc/navTableauDeBord.html.twig', array('liensTableauDeBord' =>$liensTableauDeBord));
    }
    
    
}