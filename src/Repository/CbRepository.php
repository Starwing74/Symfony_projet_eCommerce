<?php

namespace App\Repository;

use App\Entity\Cb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cb|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cb|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cb[]    findAll()
 * @method Cb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CbRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cb::class);
    }

    // /**
    //  * @return Cb[] Returns an array of Cb objects
    //  */
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
    public function findOneBySomeField($value): ?Cb
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
