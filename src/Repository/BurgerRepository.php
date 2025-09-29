<?php

namespace App\Repository;

use App\Entity\Burger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Burger>
 */
class BurgerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Burger::class);
    }

    public function findBurgersWithIngredient(string $oignon, string $sauce, string $pain) : array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT b
            FROM App\Entity\Burger b
            JOIN b.oignon o
            JOIN b.pain p
            JOIN b.sauce s
            WHERE o.id = :oignon
            AND p.id = :pain
            AND s.id = :sauce'
        )
        ->setParameter('oignon', $oignon)
        ->setParameter('pain', $pain)
        ->setParameter('sauce', $sauce);

        return $query->getResult();
    }

    //    /**
    //     * @return Burger[] Returns an array of Burger objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Burger
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
