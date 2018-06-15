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

//connexion avec la table produit pour la fonction produits
use App\Entity\Produits;

//pour les produits, dans la classe Produit, j'ai fait un lien avec les categorie, alors il faut que j'etablisse le lien ici aussi
use App\Entity\Categories;


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
        return $this->render('public/index.html.twig', array('title' => 'Bienvenue chez LiliBoutique!', 'h1' => 'Bienvenue chez LiliBoutique !'));
    }
    
    /**
    * @Route(
    *   "/produits",
    *   name = "produits")
    */
    
    //Page d'accueil, qui apparaisse dans l'url
    public function produits()
    {
        //appel du modele Produits
        $produits = $this->getDoctrine()->getRepository(Produits::class);
        //liste de tous les produits (SELECT * FROM produits)
        $listeProduits = $produits->findAll();
        return $this->render('public/produits.html.twig', array('title' => 'Produits', 'h1' => 'Produits', 'produits' => $listeProduits));
    }
    
    
    /**
    * @Route(
    *   "/detailProduit/{id}",
    *   name = "detailProduit",
    *   requirements={"id":"\d+"},
    *   defaults={"id":1})
    */
    
    //Page d'accueil, qui apparaisse dans l'url
    public function detailProduit($id)
    {
        //appel du modele Produits (c'est comme si je faisais un new Produit)
        $produits = $this->getDoctrine()->getRepository(Produits::class);
        //infos du produit (SELECT * FROM produits WHERE id= :id)
        $detailProduit = $produits->find($id);
        
        return $this->render('public/detailProduit.html.twig', array('title' => $detailProduit->getNomProduit(), 'h1' => $detailProduit->getNomProduit(), 'detail' => $detailProduit));
    }
        
    /**
    * @Route(
    *   "/mentionsLegales",
    *   name = "mentionsLegales")
    */
    
    //Page d'accueil, qui apparaisse dans l'url
    public function mentionsLegales()
    {
        return $this->render('public/mentionsLegales.html.twig', array('title' => 'Mentions Légales de LiliBoutique!', 'h1' => 'Mentions Légales'));
    }
    
}