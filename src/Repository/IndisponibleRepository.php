<?php

namespace App\Repository;

use App\Entity\Indisponible;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Indisponible|null find($id, $lockMode = null, $lockVersion = null)
 * @method Indisponible|null findOneBy(array $criteria, array $orderBy = null)
 * @method Indisponible[]    findAll()
 * @method Indisponible[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndisponibleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Indisponible::class);
    }

//    /**
//     * @return Indisponible[] Returns an array of Indisponible objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Indisponible
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function calendrier_indispo($id): array
    {
        $connexion = $this->getEntityManager()->getConnection();
        
        $parametres = array();
        
        $sql = "SELECT jour_indisponible FROM indisponible AS i
                LEFT JOIN salle AS s
                ON s.id = i.id_salle_id
                WHERE ";
        $sql .= "i.id_salle_id = :id";
        
        $parametres[":id"] = $id;
        //file_put_contents('c:/xampp/htdocs/EasyOffice/sql.txt', $sql.PHP_EOL);
        $stmt = $connexion->prepare($sql);
                $stmt->execute($parametres);//equivaut à un bindParam
                return $stmt->fetchAll();
    }

}
