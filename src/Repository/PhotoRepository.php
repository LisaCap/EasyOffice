<?php

namespace App\Repository;

use App\Entity\Photo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Photo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Photo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Photo[]    findAll()
 * @method Photo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Photo::class);
    }

//    /**
//     * @return Photo[] Returns an array of Photo objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Photo
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function recupPhoto($id): array
    {
        //$id corrrespond à l'id salle
        
        //dans cette fonction, nous venons de la page index et nous arrivons sur la page salle, et nous avons rempli au moins une partie de la requete dans le formulaire d'entrée de critere partiel 
        
        $connexion = $this->getEntityManager()->getConnection();
        
        $parametres = array();
            
        $sql = "SELECT lien_photo_default, lien_photo_details FROM photo AS p
                LEFT JOIN salle AS s 
                ON s.id = p.id_salle_id
                WHERE ";
        
        $sql .= "p.id_salle_id = :id";
        
        $parametres[":id"] = $id;
        
        $stmt = $connexion->prepare($sql);
        $stmt->execute($parametres);//equivaut à un bindParam
        return $stmt->fetchAll();
    }
}
