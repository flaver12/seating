<?php

namespace App\Repository;

use App\Entity\Entrance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Entrance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entrance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entrance[]    findAll()
 * @method Entrance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntranceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Entrance::class);
    }

    // /**
    //  * @return Entrance[] Returns an array of Entrance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Entrance
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
