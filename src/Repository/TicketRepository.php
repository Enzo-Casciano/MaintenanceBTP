<?php

namespace App\Repository;

use App\Entity\Ticket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ticket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ticket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ticket[]    findAll()
 * @method Ticket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketRepository extends ServiceEntityRepository
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
                   ->join('t.criticite', 'c')
                   ->addSelect('c')
                   ->where('s.nomStatut != ?1')
                   ->setParameter(1, $nomStatut);
        return $qb->getQuery()
                  ->getResult();
    }

    public function updateStatutTicket($idTicket, $idStatut)
    {
        return $this->createQueryBuilder('t')
        ->update()
        ->set('t.statut', '?1')
        ->where('t.id = ?2')
        ->setParameter(1, $idStatut)
        ->setParameter(2, $idTicket)
        ->getQuery()
        ->getResult();
    }

    public function updateCriticiteTicket($idTicket, $idCriticite)
    {
        return $this->createQueryBuilder('t')
        ->update()
        ->set('t.criticite', '?1')
        ->where('t.id = ?2')
        ->setParameter(1, $idCriticite)
        ->setParameter(2, $idTicket)
        ->getQuery()
        ->getResult();
    }

    public function updateInterventionTicket($idTicket, $idIntervention)
    {
        return $this->createQueryBuilder('t')
        ->update()
        ->set('t.intervention', '?1')
        ->where('t.id = ?2')
        ->setParameter(1, $idIntervention)
        ->setParameter(2, $idTicket)
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
                   ->where('s.nomStatut = ?1')
                   ->setParameter(1, $nomStatut);
        return $qb->getQuery()
                  ->getResult();
    }

    public function getStatutTicket($idTicket)
    {
        $qb = $this->createQueryBuilder('t')
                   ->join('t.statut', 's')
                   ->addSelect('s')
                   ->select('s.id')
                   ->where('t.id = ?1')
                   ->setParameter(1, $idTicket);
        return $qb->getQuery()
                  ->getResult();
    }
    // /**
    //  * @return Ticket[] Returns an array of Ticket objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ticket
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
