<?php

namespace App\Repository;

use App\Entity\ContratPret;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContratPret>
 *
 * @method ContratPret|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContratPret|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContratPret[]    findAll()
 * @method ContratPret[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContratPretRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContratPret::class);
    }

//    /**
//     * @return ContratPret[] Returns an array of ContratPret objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ContratPret
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
