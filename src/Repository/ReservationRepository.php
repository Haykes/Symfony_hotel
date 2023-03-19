<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function save(Reservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function isReservationAvailable(Reservation $reservation): bool
    {
        $conflictingReservations = $this->createQueryBuilder('r')
            ->where('r.suite = :suite')
            ->andWhere('r.startDate < :endDate')
            ->andWhere('r.endDate > :startDate')
            ->setParameters([
                'suite' => $reservation->getSuite(),
                'startDate' => $reservation->getStartDate(),
                'endDate' => $reservation->getEndDate(),
            ])
            ->getQuery()
            ->getResult();

        return count($conflictingReservations) === 0;
    }
}
