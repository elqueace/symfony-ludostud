<?php

namespace App\Repository;

use App\Entity\OwnerId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OwnerId|null find($id, $lockMode = null, $lockVersion = null)
 * @method OwnerId|null findOneBy(array $criteria, array $orderBy = null)
 * @method OwnerId[]    findAll()
 * @method OwnerId[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OwnerIdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OwnerId::class);
    }

    // /**
    //  * @return OwnerId[] Returns an array of OwnerId objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OwnerId
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
