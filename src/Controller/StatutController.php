<?php

namespace App\Controller;

use App\Entity\Criticite;
use App\Entity\Intervention;
use App\Entity\Materiel;
use App\Entity\Niveau;
use App\Entity\Salle;
use App\Entity\Statut;
use App\Entity\Ticket;
use App\Entity\Utilisateur;
use App\Entity\Zone;
use App\Form\CriticiteType;
use App\Form\StatutType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StatutRepository;
use App\Repository\TicketRepository;

class StatutController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('statut/index.html.twig', [
            'controller_name' => 'StatutController',
        ]);
    }

    public function showTickets(TicketRepository $ticketRep){

        $ticket = $this->getDoctrine()
                       ->getRepository(Ticket::class)
                       ->findAll();

        $salle = $this->getDoctrine()
                      ->getRepository(Salle::class)
                      ->findAll();
        
        $statut = $this->getDoctrine()
                      ->getRepository(Statut::class)
                      ->findAll();

        $user = $this->getDoctrine()
                      ->getRepository(Utilisateur::class)
                      ->findAll();
        
        $criticite = $this->getDoctrine()
                      ->getRepository(Criticite::class)
                      ->findAll();

        $listeTickets = $ticketRep->getTicketsDetails('En attente');

        return $this->render('tableDemandes/index.html.twig',[
                        'criticite' => $criticite,
                        'ticket' => $ticket,
                        'salle' => $salle,
                        'statut' => $statut,
                        'utilisateur' => $user,
                        'listeTicket' => $listeTickets
            ]);
    }

    public function showOneTicket($id, TicketRepository $ticketRep, StatutRepository $statutRep){

        $ticket = $this->getDoctrine()
                       ->getRepository(Ticket::class)
                       ->find($id);

        $salle = $this->getDoctrine()
                      ->getRepository(Salle::class)
                      ->find($id);

        $niveau = $this->getDoctrine()
                      ->getRepository(Niveau::class)
                      ->find($id);

        $zone = $this->getDoctrine()
                      ->getRepository(Zone::class)
                      ->find($id);

        $materiel = $this->getDoctrine()
                      ->getRepository(Materiel::class)
                      ->find($id);

        $criticite = $this->getDoctrine()
                          ->getRepository(Criticite::class)
                          ->find($id);

        $form = $this->createForm(CriticiteType::class, $criticite);

        if($ticketRep->getStatutTicket($id) != $statutRep->getStatut(3) && $ticketRep->getStatutTicket($id) != $statutRep->getStatut(1)) {
            $ticketRep->updateStatutTicket($id, 2);
        }

        if($ticketRep->getStatutTicket($id) === $statutRep->getStatut(4)) {
            $ticketRep->updateCriticiteTicket($id, 4);
        }

        return $this->render('vueDemande/index.html.twig',[
                        'form' => $form->createView(),
                        'criticite' => $criticite,
                        'ticket' => $ticket,
                        'salle' => $salle,
                        'niveau' => $niveau,
                        'zone' => $zone,
                        'materiel' => $materiel
            ]);
    }

    public function showResultTicket($id){

        $ticket = $this->getDoctrine()
                       ->getRepository(Ticket::class)
                       ->find($id);

        $utilisateur = $this->getDoctrine()
                            ->getRepository(Utilisateur::class)
                            ->find($id);

        $statut = $this->getDoctrine()
                       ->getRepository(Statut::class)
                       ->find($id);

        $salle = $this->getDoctrine()
                      ->getRepository(Salle::class)
                      ->find($id);

        $niveau = $this->getDoctrine()
                       ->getRepository(Niveau::class)
                       ->find($id);

        $zone = $this->getDoctrine()
                      ->getRepository(Zone::class)
                      ->find($id);

        $materiel = $this->getDoctrine()
                         ->getRepository(Materiel::class)
                         ->find($id);

        $intervention = $this->getDoctrine()
                             ->getRepository(Intervention::class)
                             ->find($id);

        return $this->render('vueResultat/index.html.twig',[
                        'ticket' => $ticket,
                        'utilisateur' => $utilisateur,
                        'salle' => $salle,
                        'statut' => $statut,
                        'niveau' => $niveau,
                        'zone' => $zone,
                        'materiel' => $materiel,
                        'intervention' => $intervention
            ]);
    }

    public function showTicketsAdmin(TicketRepository $ticketRep){

        $listeTicketsAttente = $ticketRep->getTicketsAttente('En attente');

        return $this->render('tableDemandesAdmin/index.html.twig',[
                        
                        'listeTicketsAttente' => $listeTicketsAttente
            ]);
    }
}


