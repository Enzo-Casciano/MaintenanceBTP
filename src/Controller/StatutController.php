<?php

namespace App\Controller;

use App\Form\TicketCriticiteType;
use App\Form\TicketType;
use App\Repository\CriticiteRepository;
use App\Repository\InterventionRepository;
use App\Repository\MaterielRepository;
use App\Repository\NiveauRepository;
use App\Repository\SalleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StatutRepository;
use App\Repository\TicketRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\ZoneRepository;

class StatutController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('statut/index.html.twig', [
            'controller_name' => 'StatutController',
        ]);
    }

    public function showTickets(TicketRepository $ticketRep, SalleRepository $salleRep, StatutRepository $statutRep, UtilisateurRepository $utilisateurRep){

        $ticket = $ticketRep->findAll();

        $salle = $salleRep->findAll();
        
        $statut = $statutRep->findAll();

        $user = $utilisateurRep->findAll();

        $listeTickets = $ticketRep->getTicketsDetails('En attente');
        
        return $this->render('tableDemandes/index.html.twig',[
            'ticket' => $ticket,
            'salle' => $salle,
            'statut' => $statut,
            'utilisateur' => $user,
            'listeTicket' => $listeTickets
            ]);
        }
        
        public function showOneTicket(Request $request, $id, TicketRepository $ticketRep, SalleRepository $salleRep, StatutRepository $statutRep, NiveauRepository $niveauRep, ZoneRepository $zoneRep, MaterielRepository $materielRep){
            
        $em = $this->getDoctrine()->getManager();
        $ticket = $ticketRep->find($id);
        // $materiel = $ticket->getMateriels();

        $salle = $salleRep->find($id);

        $niveau = $niveauRep->find($id);

        $zone = $zoneRep->find($id);

        $materiel = $materielRep->find($id);

        $form = $this->createForm(TicketCriticiteType::class, $ticket);

        if($ticketRep->getStatutTicket($id) != $statutRep->getStatut(3)) {
            $ticketRep->updateStatutTicket($id, 2);
        }

        if($ticketRep->getStatutTicket($id) === $statutRep->getStatut(4)) {
            $ticketRep->updateCriticiteTicket($id, 4);
        }

        $form->handleRequest($request);
        if($form->isSubmitted()){

            $em->persist($ticket);
            $em->flush();

            return $this->redirectToRoute('validationdemande');
        }

        return $this->render('vueDemande/index.html.twig',[
                        'form' => $form->createView(),
                        'ticket' => $ticket,
                        'salle' => $salle,
                        'niveau' => $niveau,
                        'zone' => $zone,
                        'materiel' => $materiel
            ]);
    }

    public function showResultTicket($id, TicketRepository $ticketRep, SalleRepository $salleRep, UtilisateurRepository $utilisateurRep, StatutRepository $statutRep, NiveauRepository $niveauRep, ZoneRepository $zoneRep, MaterielRepository $materielRep, InterventionRepository $interventionRep){

        $ticket = $ticketRep->find($id);

        $utilisateur = $utilisateurRep->find($id);

        $statut = $statutRep->find($id);

        $salle = $salleRep->find($id);

        $niveau = $niveauRep->find($id);

        $zone = $zoneRep->find($id);

        $materiel = $materielRep->find($id);

        $intervention = $interventionRep->find($id);

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


