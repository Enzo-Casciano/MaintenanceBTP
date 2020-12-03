<?php

namespace App\Repository;

use App\Entity\Ticket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Statut|null find($id, $lockMode = null, $lockVersion = null)
 * @method Statut|null findOneBy(array $criteria, array $orderBy = null)
 * @method Statut[]    findAll()
 * @method Statut[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }

    public function getTicketsDetails($nomStatut)
    {
        $qb = $this->createQueryBuilder('t')
                   ->join('t.utilisateur', 'u')
                   ->addSelect('u')
                   ->join('t.statut', 's')
                   ->addSelect('s')
                   ->join('t.salles', 'sa')
                   ->addSelect('sa')
                   ->where('s.nomStatut != ?1')
                   ->setParameter(1, $nomStatut);
        return $qb->getQuery()
                  ->getResult();
    }

    public function updateStatutTicket($idticket, $idstatut)
    {
        return $this->createQueryBuilder('t')
        ->update()
        ->set('t.statut', '?1')
        ->where('t.id = ?2')
        ->setParameter(1, $idstatut)
        ->setParameter(2, $idticket)
        ->getQuery()
        ->getResult();
    }

    public function getTicketsAttente($nomStatut)
    {
        $qb = $this->createQueryBuilder('t')
                   ->join('t.utilisateur', 'u')
                   ->addSelect('u')
                   ->join('t.statut', 's')
                   ->addSelect('s')
                   ->join('t.salles', 'sa')
                   ->addSelect('sa')
                   ->where('s.nomStatut = ?1')
                   ->setParameter(1, $nomStatut);
        return $qb->getQuery()
                  ->getResult();
    }

    // /**
    //  * @return Statut[] Returns an array of Statut objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Statut
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
