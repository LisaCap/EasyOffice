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
    
    
//    /**
//     * @return Salle[] Returns an array of Salle objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Salle
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    
//si par exemple $capacite est rempli, il ecrase la valeur qui est entré dans la function salleRecherche
//le ='' est simplement une valeur par default
    public function salleRecherche($ville, $date, $categorie, $cp, $capacite, $surface, $nom, $nbrPiece, $prixMin, $prixMax): array
    {
        $connexion = $this->getEntityManager()->getConnection();
        
        //pour faire le bindParam lors de l'execution de la requete
        $parametres = array();
        
        //selon le contenu des variable, on les passe en parametre, pour le BindParam

        if($ville == "tous" && $date === null && $categorie == "tous" && $cp === null && $capacite === null && $surface === null && $nom === null && $nbrPiece === null && $prixMin === null && $prixMax === null)
        {
            //select * si le formulaire est validé mais que rien n'a été rempli. On retrouve donc toutes les valeurs par default qui ont été renseigné dans le PublicController
            //on fait la jointure avec les photo et les categories pour retrouver les noms
            $sql = "SELECT * FROM salle AS s
                    LEFT JOIN photo AS p 
                    ON s.id = p.id_salle_id
                    LEFT JOIN categorie_salle AS c
                    ON s.id_categorie_salle_id = c.id";
            
            $stmt = $connexion->prepare($sql);
            file_put_contents('c:/xampp/htdocs/EasyOffice/sql2.txt', $sql.PHP_EOL);
            $stmt->execute();//equivaut à un bindParam
            return $stmt->fetchAll();

        } else
        {
            //au moins un champ a été rempli, donc il y a forcement un WHERE
            $sql = "SELECT * FROM salle AS s
                    LEFT JOIN photo AS p 
                    ON s.id = p.id_salle_id
                    LEFT JOIN categorie_salle AS c
                    ON s.id_categorie_salle_id = c.id
                    WHERE 1=1";
                    //ici on met WHERE 1=1 pour eviter de faire des requete de if a rallonge qui pourrait provoquer des erreurs. Comme ça on a simplement les AND a gerer

                    if($date != null)
                    {
                        $sqlDate = "s.id NOT IN ( SELECT id_salle_id FROM indisponible where jour_indisponible = :date )";
                        $parametres[":date"] = $date;
                        //on rentre la suite de la requete dans $sql
                        $sql .= " AND " . $sqlDate ;
                    }
            
                    if($ville != "tous")
                    {
                        //ici la ville peut se nommer "tous" ou c'est un string
                        $sqlVille = "s.ville_salle = :ville";
                        $parametres[":ville"] = $ville;
                        //on la passe dans la requete
                        $sql.= " AND " . $sqlVille;
                    }
            
                    if($categorie != "tous")
                    {
                        //ici la categorie peut se nommer "tous", ou c'est un numéro
                        $sqlCategorie = "s.id_categorie_salle_id = :categorie";
                        $parametres[":categorie"] = $categorie;
                        //on la passe dans la requete sql
                        $sql.= " AND " . $sqlCategorie;
                    }
            
                    if($cp != null)
                    {
                        //ici la categorie peut se nommer "tous", ou c'est un numéro
                        $sqlCp = "s.cp_salle = :cp";
                        $parametres[":cp"] = $cp;
                        //on la passe dans la requete sql
                        $sql.= " AND " . $sqlCp;
                    }
            
                    if($capacite != null)
                    {
                        //ici la categorie peut se nommer "tous", ou c'est un numéro
                        $sqlCapacite = "s.capacite_salle >= :capacite";
                        $parametres[":capacite"] = $capacite;
                        //on la passe dans la requete sql
                        $sql.= " AND " . $sqlCapacite;
                    }
            
                    if($surface != null)
                    {
                        //ici la categorie peut se nommer "tous", ou c'est un numéro
                        $sqlSurface = "s.surface_salle = :surface";
                        $parametres[":surface"] = $surface;
                        //on la passe dans la requete sql
                        $sql.= " AND " . $sqlSurface;
                    }
            
                    if($nom != null)
                    {
                        //ici la categorie peut se nommer "tous", ou c'est un numéro
                        $sqlNom = "s.nom_salle = :nom";
                        $parametres[":nom"] = $surface;
                        //on la passe dans la requete sql
                        $sql.= " AND " . $sqlNom;
                    }
            
                    if($nbrPiece != null)
                    {
                        //ici la categorie peut se nommer "tous", ou c'est un numéro
                        $sqlNbrPiece = "s.nbr_piece_salle = :nbrPiece";
                        $parametres[":nbrPiece"] = $nbrPiece;
                        //on la passe dans la requete sql
                        $sql.= " AND " . $sqlNbrPiece;
                    }
            
                    
                    if($prixMin != null)
                    {
                        //ici la categorie peut se nommer "tous", ou c'est un numéro
                        $sqlPrixMin = "s.prix_salle >= :prixMin";
                        $parametres[":prixMin"] = $prixMin;
                        //on la passe dans la requete sql
                        $sql.= " AND " . $sqlPrixMin;
                    }
            
                    if($prixMax != null)
                    {
                        //ici la categorie peut se nommer "tous", ou c'est un numéro
                        $sqlPrixMax = "s.prix_salle <= :prixMax";
                        $parametres[":prixMax"] = $prixMax;
                        //on la passe dans la requete sql
                        $sql.= " AND " . $sqlPrixMax;
                    }
            
            
                    //EQUIPEMENT ???????
                    /*if(!empty($ville))
                    {
                        $parametres[":ville"] = $ville;
                    }*/
                    
                    $stmt = $connexion->prepare($sql);
                    file_put_contents('c:/xampp/htdocs/EasyOffice/sql2.txt', $sql.PHP_EOL);
                    $stmt->execute($parametres);//equivaut à un bindParam
                    return $stmt->fetchAll();
        
        }
    }
    
    public function indexRecherche($ville, $date, $categorie): array
    {
        
        //dans cette fonction, nous venons de la page index et nous arrivons sur la page salle, et nous avons rempli au moins une partie de la requete dans le formulaire d'entrée de critere partiel 
        
        $connexion = $this->getEntityManager()->getConnection();
        
        //pour faire le bindParam lors de l'execution de la requete
        $parametres = array();
        
            
            //ici on est dans le cas ou le user clique su =r valider dans le formulaire d'index et qu'il n'a rien rempli
            
            $sql = "SELECT * FROM salle AS s
                    LEFT JOIN photo AS p 
                    ON s.id = p.id_salle_id
                    LEFT JOIN categorie_salle AS c
                    ON s.id_categorie_salle_id = c.id
                    WHERE ";

            //si la date est differente de celle par défault (null)
            if($date != null)
            {
                $sqlDate = "s.id NOT IN ( SELECT id_salle_id FROM indisponible where jour_indisponible = :date )";
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
        
        $sql = "SELECT * FROM salle AS s
                LEFT JOIN photo AS p 
                ON s.id = p.id_salle_id
                LEFT JOIN categorie_salle AS c
                ON s.id_categorie_salle_id = c.id";
        file_put_contents('c:/xampp/htdocs/EasyOffice/sql.txt', $sql.PHP_EOL);
        $stmt = $connexion->prepare($sql);
                $stmt->execute();//equivaut à un bindParam
                return $stmt->fetchAll();
    }
}
