<?php
//src/Controller/MenuController.php
namespace App\Controller; //on est dans le dossier src, mais on ecrit App. C'est son nom pour l'appeler (c'est par rapport à l'autolaod)

//creer le lien avec Twig
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// filtrer les admin et les user, avec isGranted
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

use Symfony\Component\HttpFoundation\Response; //retourner une reponse au format HTML

use Symfony\Component\Routing\Annotation\Route; //pour utiliser les annotation installé via le sension/extra-bundle (voir config symphony)
//il y a eu une creation de fichier dans config/routes/annotations.yaml


class IncController extends Controller
{
    public function navbar(AuthorizationCheckerInterface $authChecker)
    {
        //si l'utilisateur est loggué et possede les droits ROLE_ADMIN
        if($authChecker->isGranted('ROLE_ADMIN'))
        {
            $liens = array(
                array('href' => 'produits', 'libelle_lien' => 'Produits'),
                array('href' => 'panier', 'libelle_lien' => 'Panier'),
                array('href' => 'gestionClients', 'libelle_lien' => ' Gestion Clients'),
                array('href' => 'ajoutProduit', 'libelle_lien' => 'Ajout Produit'),
                array('href' => 'logout', 'libelle_lien' => 'Deconnexion'));
        }
        
        //si l'utilisateur est loggué et possede les droits ROLE_USER
        elseif($authChecker->isGranted('ROLE_USER'))
        {
            $liens = array(
                array('href' => 'profil', 'libelle_lien' => 'Profil'),
                array('href' => 'panier', 'libelle_lien' => 'Panier'),
                array('href' => 'produits', 'libelle_lien' => 'Produits'),
                array('href' => 'serviceClient', 'libelle_lien' => 'Service client'),
                array('href' => 'logout', 'libelle_lien' => 'Deconnexion'));
        }
        //pour les autres
        else
        {
            $liens = array(
                array('href' => 'produits', 'libelle_lien' => 'Produits'),
                array('href' => 'contact', 'libelle_lien' => 'Contact'),
                array('href' => 'inscription', 'libelle_lien' => 'Inscription'),
                array('href' => 'login', 'libelle_lien' => 'Connexion'));
        }
        
        return $this->render('inc/navbar.html.twig', array('liens' =>$liens));
    }
    
    public function footer()
    {
        // faire apparaitre la date et l'heure
        $dte = date('d/m/Y H:i:s');
        //appel du template footer.html.twig
        return $this->render('inc/footer.html.twig', array('dte' => $dte));
    }
    
}