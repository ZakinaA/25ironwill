<?php

namespace App\Repository;

use App\Entity\TrancheQuotient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TrancheQuotient>
 *
 * @method TrancheQuotient|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrancheQuotient|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrancheQuotient[]    findAll()
 * @method TrancheQuotient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrancheQuotientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrancheQuotient::class);
    }

//    /**
//     * @return TrancheQuotient[] Returns an array of TrancheQuotient objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TrancheQuotient
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
