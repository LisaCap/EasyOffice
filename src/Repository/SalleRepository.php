<?php

namespace App\Repository;

use App\Entity\Salle;
use App\Entity\Indisponible;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Salle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Salle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Salle[]    findAll()
 * @method Salle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Salle::class);
    }
    
//si par exemple $capacite est rempli, il ecrase la valeur qui est entré dans la function salleRecherche
//le ='' est simplement une valeur par default
    public function salleRecherche($ville = '', $date = '', $categorie='', $codePostal = '',  $capacite='', $surface='', $nom='', $nbrPiece='', $prixMin='', $prixMax=''): array
    {
        $connexion = $this->getEntityManager()->getConnection();
        
        //pour faire le bindParam lors de l'execution de la requete
        $parametres = array();
        
        $parametres[":ville"] = $ville;
        $parametres[":date"] = $date;
        $parametres[":categorie"] = $categorie;
        
        //pour configurer le bindParam, on lui passe les variables recuperé du formulaire
        if(!empty($codePostal))
        {
            $parametres[":codePostal"] = $codePostal;
        }
        
        if(!empty($capacite))
        {
            $parametres[":capacite"] = $capacite;
        }
        
        if(!empty($surface))
        {
            $parametres[":surface"] = $surface;
        }
        
        if(!empty($nom))
        {
            $parametres[":nom"] = $nom;
        }
        
        if(!empty($nbrPiece))
        {
            $parametres[":nbrPiece"] = $nbrPiece;
        }
        
        if(!empty($prixMin))
        {
            $parametres[":prixMin"] = $prixMin;
        }
        
        if(!empty($prixMax))
        {
            $parametres[":prixMax"] = $prixMax;
        }
        
        //EQUIPEMENT ???????
        /*if(!empty($ville))
        {
            $parametres[":ville"] = $ville;
        }*/

            
        
            //selon si les variable ont été remplis dans le formulaire sur l'index
            if($ville = "tous" && $date = "none" && $categorie = "tous")
            {
                $sql = "SELECT * FROM salle";
                
            } else
            {
                $sql = "SELECT * FROM salle as s
                        LEFT JOIN indisponible as i
                        ON s.id = i.id_salle_id
                        WHERE ";

                        if($date != 'none')
                        {
                            $sql.="i.jourIndisponible <> :date";
                            $parametres[":date"] = $date;
                                
                        }
                
                        
            }

        $stmt = $connexion->prepare($sql);
        $stmt->execute($parametres);//equivaut à un bindParam
        return $stmt->fetchAll();
    }
    
    public function indexRecherche($ville, $date, $categorie): array
    {
        
        //dans cette fonction, nous venons de la page index et nous arrivons sur la page salle, et nous avons rempli au moins une partie de la requete dans le formulaire d'entrée de critere partiel 
        
        $connexion = $this->getEntityManager()->getConnection();
        
        //pour faire le bindParam lors de l'execution de la requete
        $parametres = array();
        
            
            //ici on est dans le cas ou le user clique su =r valider dans le formulaire d'index et qu'il n'a rien rempli
            
            $sql = "SELECT * FROM salle AS s
                    LEFT JOIN indisponible AS i
                    ON s.id = i.id_salle_id
                    WHERE ";

            //si la date est differente de celle par défault (null)
            if($date != null)
            {
                $sqlDate = "(i.jour_indisponible <> :date OR i.jour_indisponible is null)";
                $parametres[":date"] = $date;
                //on rentre la suite de la requete dans $sql
                $sql .= $sqlDate ;
            }

            //si la ville est different de 'tous', et date different de null, cela veut dire que on a un premier "WHERE", et donc qu'il faut rajouter AND
            if($ville != 'tous' && $date != null)
            {
                //ici la ville peut se nommer "tous" ou c'est un string
                $sqlVille = "s.ville_salle = :ville";
                $parametres[":ville"] = $ville;
                //on la passe dans la requete
                $sql.= " AND " . $sqlVille;
            }elseif($ville != 'tous' && $date == null)
            {
                $sqlVille = "s.ville_salle = :ville";
                $parametres[":ville"] = $ville;
                //on la passe dans la requete
                $sql.= $sqlVille;
            }

            //si la categorie est differente de 'tous' on passe l'id recuperer via la route pour aller à salle
            if($categorie != 'tous' && ($ville != 'tous' || $date != null))
            {
                //ici la categorie peut se nommer "tous", ou c'est un numéro
                $sqlCategorie = "s.id_categorie_salle_id = :categorie";
                $parametres[":categorie"] = $categorie;
                //on la passe dans la requete sql
                $sql.= " AND " . $sqlCategorie;
                
            //donc ici $ville et $date sont les valeurs par default. donc ici c'est noitre premier WHERE
            }elseif($categorie != 'tous' && $ville == 'tous' && $date == null)
            {
                $sqlCategorie = "s.id_categorie_salle_id = :categorie";
                $parametres[":categorie"] = $categorie;
                //on la passe dans la requete sql
                $sql.= $sqlCategorie;
            }
            ///PROBLEMES UTF-8 SUR LES VILLES POUR LES REQUETES
            file_put_contents('c:/xampp/htdocs/EasyOffice/sql.txt', $sql.PHP_EOL);
            $stmt = $connexion->prepare($sql);
            $stmt->execute($parametres);//equivaut à un bindParam
            return $stmt->fetchAll();
                
    }
    
    public function sallesToutes($ville, $date, $categorie): array
    {
        $connexion = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT * FROM salle";
        file_put_contents('c:/xampp/htdocs/EasyOffice/sql.txt', $sql.PHP_EOL);
        $stmt = $connexion->prepare($sql);
                $stmt->execute();//equivaut à un bindParam
                return $stmt->fetchAll();
    }
}
