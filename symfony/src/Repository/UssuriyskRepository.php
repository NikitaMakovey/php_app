<?php

namespace App\Repository;

use App\Entity\Ussuriysk;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ussuriysk|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ussuriysk|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ussuriysk[]    findAll()
 * @method Ussuriysk[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UssuriyskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ussuriysk::class);
    }

    // /**
    //  * @return Ussuriysk[] Returns an array of Ussuriysk objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ussuriysk
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
