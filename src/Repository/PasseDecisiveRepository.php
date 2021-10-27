<?php

namespace App\Repository;

use App\Entity\PasseDecisive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PasseDecisive|null find($id, $lockMode = null, $lockVersion = null)
 * @method PasseDecisive|null findOneBy(array $criteria, array $orderBy = null)
 * @method PasseDecisive[]    findAll()
 * @method PasseDecisive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PasseDecisiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PasseDecisive::class);
    }

    // /**
    //  * @return PasseDecisive[] Returns an array of PasseDecisive objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PasseDecisive
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
