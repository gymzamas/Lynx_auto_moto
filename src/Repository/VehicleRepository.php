<?php

namespace App\Repository;

use App\Entity\Vehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vehicle>
 */
class VehicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicle::class);
    }

    /**
     * Méthode pour filtrer les véhicules selon le kilométrage, le prix et l'année
     */
    public function findByFilters($minMileage, $maxMileage, $minPrice, $maxPrice, $minYear, $maxYear)
    {
        $qb = $this->createQueryBuilder('v');

        $qb->where('v.mileage BETWEEN :minMileage AND :maxMileage')
           ->setParameter('minMileage', $minMileage)
           ->setParameter('maxMileage', $maxMileage);

        $qb->andWhere('v.price BETWEEN :minPrice AND :maxPrice')
           ->setParameter('minPrice', $minPrice)
           ->setParameter('maxPrice', $maxPrice);

        $qb->andWhere('v.year BETWEEN :minYear AND :maxYear')
           ->setParameter('minYear', $minYear)
           ->setParameter('maxYear', $maxYear);

        return $qb->getQuery()->getResult();
    }

    //    /**
    //     * @return Vehicle[] Returns an array of Vehicle objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Vehicle
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
