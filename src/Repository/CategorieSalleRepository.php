<?php

namespace App\Repository;

use App\Entity\CategorieSalle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategorieSalle|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieSalle|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieSalle[]    findAll()
 * @method CategorieSalle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieSalleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategorieSalle::class);
    }

//    /**
//     * @return CategorieSalle[] Returns an array of CategorieSalle objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategorieSalle
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
