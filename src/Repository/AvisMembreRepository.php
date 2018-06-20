<?php

namespace App\Repository;

use App\Entity\AvisMembre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AvisMembre|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvisMembre|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvisMembre[]    findAll()
 * @method AvisMembre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvisMembreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AvisMembre::class);
    }

//    /**
//     * @return AvisMembre[] Returns an array of AvisMembre objects
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
    public function findOneBySomeField($value): ?AvisMembre
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
