<?php

namespace App\Repository;

use App\Entity\EquipeSaisonJoueur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EquipeSaisonJoueur|null find($id, $lockMode = null, $lockVersion = null)
 * @method EquipeSaisonJoueur|null findOneBy(array $criteria, array $orderBy = null)
 * @method EquipeSaisonJoueur[]    findAll()
 * @method EquipeSaisonJoueur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipeSaisonJoueurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquipeSaisonJoueur::class);
    }

    // /**
    //  * @return EquipeSaisonJoueur[] Returns an array of EquipeSaisonJoueur objects
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
    public function findOneBySomeField($value): ?EquipeSaisonJoueur
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
