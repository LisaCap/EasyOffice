<?php
//src/Controller/PublicController.php
//on est dans le dossier src, mais on ecrit App. C'est son nom pour l'appeler (c'est par rapport à l'autolaod)
namespace App\Controller;

//retourner une reponse au format HTML
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//pour utiliser les annotations (pour les routes), sans passer par le routes.yaml
//installé via le sension/extra-bundle (voir config-symphony.txt)
use Symfony\Component\Routing\Annotation\Route;

//creer le lien avec Twig
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//connexion avec la table salle pour la fonctionsalle
use App\Entity\Salle;

//connexion avec la table Membre pour la fonction Profil (affichage du profil du membre)
use App\Entity\Membre;

//pour les produits, dans la classe Produit, j'ai fait un lien avec les categorie, alors il faut que j'etablisse le lien ici aussi
use App\Entity\CategorieSalle;


class PublicController extends Controller
{
    /**
    * @Route(
    *   "/",
    *   name = "index")
    */
    
    //Page d'accueil, qui apparaisse dans l'url
    public function index()
    {
        return $this->render('public/index.html.twig', array('title' => 'Easy Office'));
    }
    
    /**
    * @Route(
    *   "/salle",
    *   name = "salle")
    */
    
    //toutes les salles
    public function salle()
    {
        //appel du modele Salle
        $salle = $this->getDoctrine()->getRepository(Salle::class);
        //liste de toutes les salles (SELECT * FROM salle)
        $listeSalles = $salle->findAll();
        return $this->render('public/salle.html.twig', array('title' => 'Salles EasyOffice', 'salle' => $listeSalles));
    }
    
    
    /**
    * @Route(
    *   "/detailSalle/{id}",
    *   name = "detailSalle",
    *   requirements={"id":"\d+"},
    *   defaults={"id":1})
    */
    
    //Page d'accueil, qui apparaisse dans l'url
    public function detailSalle($id)
    {
        //appel du modele Salle (c'est comme si je faisais un new Produit)
        $salle = $this->getDoctrine()->getRepository(Salle::class);
        //infos de la salle (SELECT * FROM salle WHERE id= :id)
        $detailSalle = $salle->find($id);
        
        return $this->render('public/detailSalle.html.twig', array('title' => $detailSalle->getNomSalle(), 'h1' => $detailSalle->getNomSalle(), 'detail' => $detailSalle));
    }
        
    /**
    * @Route(
    *   "/mentionsLegales",
    *   name = "mentionsLegales")
    */
    
    //Page d'accueil, qui apparaisse dans l'url
    public function mentionsLegales()
    {
        return $this->render('public/mentionsLegales.html.twig', array('title' => 'Mentions Légales EasyOffice'));
    }
    
    /**
    * @Route(
    *   "/aide",
    *   name = "aide")
    */
    
    //Page d'accueil, qui apparaisse dans l'url
    public function aide()
    {
        return $this->render('public/aide.html.twig', array('title' => 'Aide EasyOffice'));
    }
    
    /**
    * @Route(
    *   "/concept",
    *   name = "concept")
    */
    
    //Page d'accueil, qui apparaisse dans l'url
    public function concept()
    {
        return $this->render('public/concept.html.twig', array('title' => 'Concept EasyOffice'));
    }
    
    /**
    * @Route(
    *   "/contact",
    *   name = "contact")
    */
    
    //Page contact, qui apparait dans l'url
    public function contact()
    {
        return $this->render('public/contact.html.twig', array('title' => 'Contact EasyOffice'));
    }
    
    /**
    * @Route(
    *   "/googleMap",
    *   name = "googleMap")
    */
    //Page googleMap, qui apparait dans l'url
    public function googleMap()
    {
        return $this->render('public/googleMap.html.twig', array('title' => 'googleMap EasyOffice'));
    }
    
}