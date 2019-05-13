<?php

namespace App\Repository;

use App\Entity\Schemator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Schemator|null find($id, $lockMode = null, $lockVersion = null)
 * @method Schemator|null findOneBy(array $criteria, array $orderBy = null)
 * @method Schemator[]    findAll()
 * @method Schemator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchematorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Schemator::class);
    }

    // /**
    //  * @return Schemator[] Returns an array of Schemator objects
    //  */
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
    public function findOneBySomeField($value): ?Schemator
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
