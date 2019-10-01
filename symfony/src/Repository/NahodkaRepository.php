<?php

namespace App\Repository;

use App\Entity\Nahodka;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Nahodka|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nahodka|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nahodka[]    findAll()
 * @method Nahodka[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NahodkaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nahodka::class);
    }

    // /**
    //  * @return Nahodka[] Returns an array of Nahodka objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nahodka
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
