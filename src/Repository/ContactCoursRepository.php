<?php

namespace App\Repository;

use App\Entity\ContactCours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContactCours>
 *
 * @method ContactCours|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactCours|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactCours[]    findAll()
 * @method ContactCours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactCoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactCours::class);
    }

//    /**
//     * @return ContactCours[] Returns an array of ContactCours objects
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

//    public function findOneBySomeField($value): ?ContactCours
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
