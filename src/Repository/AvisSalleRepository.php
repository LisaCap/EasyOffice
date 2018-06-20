<?php

namespace App\Repository;

use App\Entity\AvisSalle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AvisSalle|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvisSalle|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvisSalle[]    findAll()
 * @method AvisSalle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvisSalleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AvisSalle::class);
    }

//    /**
//     * @return AvisSalle[] Returns an array of AvisSalle objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AvisSalle
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
