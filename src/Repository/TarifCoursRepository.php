<?php

namespace App\Repository;

use App\Entity\TarifCours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TarifCours>
 *
 * @method TarifCours|null find($id, $lockMode = null, $lockVersion = null)
 * @method TarifCours|null findOneBy(array $criteria, array $orderBy = null)
 * @method TarifCours[]    findAll()
 * @method TarifCours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarifCoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TarifCours::class);
    }

//    /**
//     * @return TarifCours[] Returns an array of TarifCours objects
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

//    public function findOneBySomeField($value): ?TarifCours
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
