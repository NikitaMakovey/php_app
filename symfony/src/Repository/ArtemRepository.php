<?php

namespace App\Repository;

use App\Entity\Artem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Artem|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artem|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artem[]    findAll()
 * @method Artem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artem::class);
    }

    // /**
    //  * @return Artem[] Returns an array of Artem objects
    //  */
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
    public function findOneBySomeField($value): ?Artem
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
