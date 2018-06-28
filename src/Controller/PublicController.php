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

use App\Entity\Photo;

use App\Entity\Indisponible;

use App\Services\Calendrier;

//pour les produits, dans la classe Produit, j'ai fait un lien avec les categorie, alors il faut que j'etablisse le lien ici aussi
use App\Entity\CategorieSalle;

//pour affichage formulaire criteres index.html.twig
use App\Form\IndexType;
//pour affichage formulaire criteres salle.html.twig
use App\Form\SalleType;

//pour le formulaire de l'index
use Symfony\Component\Form\Extension\Core\Type\TextType; //input
use Symfony\Component\Form\Extension\Core\Type\DateType; //Date
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; //categorie

use Symfony\Component\Form\Extension\Core\Type\SubmitType; //btn submit

// pour utiliser la session
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class PublicController extends Controller
{
    /**
    * @Route(
    *   "/",
    *   name = "index")
    */
    
    //Page d'accueil, qui apparaisse dans l'url
    public function index(Request $request, SessionInterface $session)
    {
        
        $defaultData = array();
        
        $form = $this->createFormBuilder($defaultData)
                ->add('ville', TextType::class, array('label' => 'Ville', 'required' => false))
                ->add('date', DateType::class,
                      array('required' => false))
                ->add('idCategorieSalle', ChoiceType::class,
                      array('choices' => array
                                        ('Tous' => 'tous','Stockage' => 1,'Séminaire / Conférence' => 2, 'Formation' => 3, 'Entretien' => 4, 'Réunion' => 5, 'Evènement' => 6),
                            'expanded' => false,
                            'multiple' => false),
                     array('required' => false))
                     
                ->add('Save', SubmitType::class, 
                               array('label' => 'Envoyer', 'attr' => ['class' => 'btn btn-info']))
                ->getForm();

        $form->handleRequest($request);
        
        //mettre les données du formulaires dans des variables pour les recuperer dans de SalleRepository
           
        if ($form->isSubmitted() && $form->isValid()) {
            
            $data = $form->getData();
            // dump($data);
            
            $ville = $data['ville'];
            // dump($ville);
                if(empty($ville))
                {
                    $ville = "tous";
                }
            $session->set('ville', $ville);

            //mettre la date dans une variable
            $date = $data['date'];
           //  dump($date);
            //pour faire un select * sur les salles sans passer par la table indisponible
            if(empty($date))
            {
                $date = null;
                $session->set('date', $date);
            }
            //si ie user rentre une date, je le met au bon format
            if($date != null)
            {
                $dateBonFormat =  $date->format('Y-m-d H:i:s');
                $session->set('date', $dateBonFormat);
            }

            //mettre la categorie dans une variable
            $categorie = $data['idCategorieSalle'];
           //  dump($categorie);
            if(empty($categorie))
            {
                $categorie = "tous";
            }
            $session->set('categorie', $categorie);

            
            return $this->redirectToRoute('salle');

        }
        
        //$session->set('toto', 1);
        //dump($session);
        
		
        return $this->render('public/index.html.twig', array('form' => $form->createView(),'title' => 'Easy Office'));
        
        
    }
    
    /**
    * @Route(
    *   "/salle",
    *   name = "salle")
    */
    
    //toutes les salles
    public function salle(Request $request, SessionInterface $session)
    {
        //voir ce qui est enregistrer dans la session
        dump($session);
        
        //creation du formulaire en premier pour povoir generer une render
        //création du formulaire
        $defaultData = array();
        
        $form = $this->createFormBuilder($defaultData)
                ->add('nom', TextType::class, array('label' => 'Nom', 'required' => false))
                ->add('cp', TextType::class, array('label' => 'Code Postal', 'required' => false))
                ->add('ville', TextType::class, array('label' => 'Ville', 'required' => false))
                ->add('date', DateType::class,
                      array('required' => false))
                ->add('idCategorieSalle', ChoiceType::class,
                      array('choices' => array
                                        ('Tous' => 'tous','Stockage' => 1,'Séminaire / Conférence' => 2, 'Formation' => 3, 'Entretien' => 4, 'Réunion' => 5, 'Evènement' => 6),
                            'expanded' => false,
                            'multiple' => false),
                     array('required' => false))
                ->add('surface', TextType::class, array('label' => 'Surface', 'required' => false))
                ->add('nbrPiece', TextType::class, array('label' => 'Nombre de pièce', 'required' => false))
                ->add('capacite', TextType::class, array('label' => 'Capacite Salle', 'required' => false))
                ->add('prixMin', TextType::class, array('label' => 'Prix minimum', 'required' => false))
                ->add('prixMax', TextType::class, array('label' => 'Prix maximum', 'required' => false))
                     
                ->add('Save', SubmitType::class, 
                               array('label' => 'Envoyer', 'attr' => ['class' => 'btn btn-info']))
                ->getForm();
         
        $form->handleRequest($request);
        
        //SI LE FORMULAIRE EST REMPLI ET SOUMIS //////////////////////////////
            if($form->isSubmitted() && $form->isValid())
            {
                
            //recuperer donnée formulaire    
            $data = $form->getData();
                
                //ensuite on traduit chaque champ du formulaire pour le placer en session
                
                /*NOM*/
                $nom = $data['nom'];
                    if(empty($nom))
                    {
                        $nom = null;
                    }
                $session->set('nom', $nom);
                
                /*CODE POSTAL*/
                $cp = $data['cp'];
                    if(empty($cp))
                    {
                        $cp = null;
                    }
                $session->set('cp', $cp);
                
                /*VILLE*/
                $ville = $data['ville'];
                    if(empty($ville))
                    {
                        $ville = "tous";
                    }
                $session->set('ville', $ville);
                
                /*DATE*/
                $date = $data['date'];
                //si ie user rentre une date, je le met au bon format
                if(!empty($date))
                {
                    $dateBonFormat =  $date->format('Y-m-d H:i:s');
                    $session->set('date', $dateBonFormat);
                }else{
                    $date = null;
                    $session->set('date', $date);
                }
                
                /*CATEGORIE*/
                $categorie = $data['idCategorieSalle'];
                    if(empty($categorie))
                    {
                        $categorie = "tous";
                    }
                $session->set('categorie', $categorie);
                
                /*SURFACE*/
                $surface = $data['surface'];
                    if(empty($surface))
                    {
                        $surface = null;
                    }
                $session->set('surface', $surface);
                
                /*NBR PIECE*/
                $nbrPiece = $data['nbrPiece'];
                    if(empty($nbrPiece))
                    {
                        $nbrPiece = null;
                    }
                $session->set('nbrPiece', $nbrPiece);
                
                /*CAPACITE*/
                $capacite = $data['capacite'];
                    if(empty($capacite))
                    {
                        $capacite = null;
                    }
                $session->set('capacite', $capacite);
                
                /*PRIX MIN*/
                $prixMin = $data['prixMin'];
                    if(empty($prixMin))
                    {
                        $prixMin = null;
                    }
                $session->set('prixMin', $prixMin);
                
                /*PRIX MAX*/
                $prixMax = $data['prixMax'];
                    if(empty($prixMax))
                    {
                        $prixMax = null;
                    }
                $session->set('prixMax', $prixMax);

                
            //recuperer les variables rentrée dans la salle pour les passer dans de SalleRepository
            $cp = $session->get('cp');
            $ville = $session->get('ville');
            $date = $session->get('date');
            $categorie = $session->get('categorie');
            $capacite = $session->get('capacite');
            $surface = $session->get('surface');
            //$equipement = $request->get('equipement');
            $nom = $session->get('nom');
            $nbrPiece = $session->get('nbrPiece');
            $prixMin = $session->get('prixMin');
            $prixMax = $session->get('prixMax');

            //connexion avec la table salle, ainsi que son repository
            $salles = $this->getDoctrine()->getRepository(Salle::class);

            //appel de la fonction qui se trouve directement dans le repository
            $listeSallesCriteres = $salles->salleRecherche($ville, $date, $categorie, $cp, $capacite, $surface, $nom, $nbrPiece, $prixMin, $prixMax);

            //direction page salle pour la recherche avec les criteres
            return $this->render('public/salle.html.twig', array('title' => 'Salles EasyOffice', 'salle' => $listeSallesCriteres, 'form' => $form->createView()));

            }
        
        //FIN FORMULAIRE SOUMIS////////////////////////////////////////////////////
        
        /////si le formulaire n'est pas soumis, on fait les autre requete possible, en finissant par la plus general, soit un select *
        
        $ville = $session->get('ville');
        $date = $session->get('date');
        $categorie = $session->get('categorie');
        
        //si le user a cliqué sur valider dans la page Index
        if( ($ville == "tous" && $categorie == "tous" && $date === null) || (empty($ville) && empty($date) && (empty($categorie) )) )
        {
            $salleTous = $this->getDoctrine()->getRepository(Salle::class);
            //liste de toutes les salles (SELECT * FROM salle)
            $listeSalles = $salleTous->sallesToutes($ville, $date, $categorie);
            ////////////////////////////////////////
            
            //si aucun critere n'est selectionné, c'est un findAll décrit audessus
            return $this->render('public/salle.html.twig', array('title' => 'Salles EasyOffice', 'salle' => $listeSalles, 'form' => $form->createView()));
        }
        //si on vient de Index et qu'on a rempli au moins une partie de la requete (donc les champ ne sont pas ceux par default)
        elseif($ville != "tous" || $categorie != "tous" || $date != null)
        {
            //on lie avec le SalleRepository, pour recuperer les salles selon une requete
            $sallesIndex = $this->getDoctrine()->getRepository(Salle::class);

            //appel de la fonction qui se trouve directement dans le repository
            $listeSallesCriteres = $sallesIndex->indexRecherche($ville, $date, $categorie);
            
            //faire un render avec la requete sql qui est dans SalleRepository
            return $this->render('public/salle.html.twig', array('title' => 'Salles EasyOffice', 'salle' => $listeSallesCriteres, 'form' => $form->createView()));
            
        }

    }
    
    
    /**
    * @Route(
    *   "/detailSalle/{id}",
    *   name = "detailSalle",
    *   requirements={"id":"\d+"},
    *   defaults={"id":1})
    */
    
    //Page d'accueil, qui apparaisse dans l'url
    public function detailSalle($id, Calendrier $calendrier)
    {
        //on appelle notre service qui va afficher le calendrier et qui est lié au IndisponibleRepository
        $calendrier_indisponible = $this->getDoctrine()->getRepository(Indisponible::class);
        $affichageCalendrier = $calendrier->creationCalendrier($id, $calendrier_indisponible);

        //recup photo
         //appel du modele Photo
        $photo = $this->getDoctrine()->getRepository(Photo::class);
        //infos de la salle (SELECT * FROM salle WHERE id= :id)
        $tablePhoto = $photo->recupPhoto($id);
        ////////////////////////
        
        
        //appel du modele Salle (c'est comme si je faisais un new Salle)
        $salle = $this->getDoctrine()->getRepository(Salle::class);
        //infos de la salle (SELECT * FROM salle WHERE id= :id)
        $detailSalle = $salle->find($id);
        dump($affichageCalendrier);
        return $this->render('public/detailSalle.html.twig', array('affichage_calendrier' => $affichageCalendrier, 'photo' => $tablePhoto, 'title' => $detailSalle->getNomSalle(), 'adresse' => $detailSalle->getAdresseSalle(), 'cp' => $detailSalle->getCpSalle(), 'ville' => $detailSalle->getVilleSalle(), 'detail' => $detailSalle ));
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
	*	  "/googleMap/{id}",
	*	  name="googleMap",
    *     requirements={"id":"\d+"},
    *     defaults={"id":1})
	*/
	public function salleGoogleMap($id)
	{
		
		//trouver l'enregistrement d'id avec $id via le repository
        $salle = $this->getDoctrine()//methode predefini de Doctrine //chercher mon mapping vers ma BDD (rapport classe/table)
                     ->getRepository(Salle::class); //le repository permet de lire dans une table
        $detailSalle = $salle->find($id);
                   // find permet de trouver la ligne dont l'id est $id
                  // ->findAll(); retourne toute la table
                  // ->findBy(['prenom' => 'Michel']); retourne tous les enregistrements dont le nom est Michel
                  // ->findOneBy(['prenom' => 'Michel', 'nom' => 'MARTIN']); retourne l'enregistrment dont le nom est MARTIN et le prenom est Michel
        
        return $this->render('public/googleMap.html.twig', array('title' => $detailSalle->getNomSalle(), 'adresse' => $detailSalle->getAdresseSalle(), 'cp' => $detailSalle->getCpSalle(), 'ville' => $detailSalle->getVilleSalle(), 'detail' => $detailSalle ));
		
	}
    
}