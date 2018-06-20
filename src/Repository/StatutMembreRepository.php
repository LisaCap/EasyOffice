<?php

namespace App\Repository;

use App\Entity\StatutMembre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StatutMembre|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatutMembre|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatutMembre[]    findAll()
 * @method StatutMembre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatutMembreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StatutMembre::class);
    }

//    /**
//     * @return StatutMembre[] Returns an array of StatutMembre objects
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
    public function findOneBySomeField($value): ?StatutMembre
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
