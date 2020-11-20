<?php

namespace App\Controller;

use App\Entity\Salle;
use App\Entity\Statut;
use App\Entity\Ticket;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StatutRepository;

class StatutController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('statut/index.html.twig', [
            'controller_name' => 'StatutController',
        ]);
    }

    public function showTicket(StatutRepository $statut){

        $listeTickets = $statut->getTicketDetails();

        // foreach($listeTickets as $ticket)
        // {
        //     Ne déclenche pas de requête : les commentaires sont déjà chargés !
        //     Vous pourriez faire une boucle dessus pour les afficher tous
        //     $ticket->();
        // }



        return $this->render('statut/index.html.twig',[
                        'listeTicket' => $listeTickets,
                        // 'utilisateur' => $utilisateur,
                        //'salle' => $salle,
                        //'statut' => $statut,
                        //'utilisateur' => $user
            ]);
    }

    public function showOneTicket($id){

        $ticket = $this->getDoctrine()
                       ->getRepository(Ticket::class)
                       ->find($id);

        // $utilisateur = $this->getDoctrine()
        //                     ->getRepository(Utilisateur::class)
        //                     ->find($id);

        $salle = $this->getDoctrine()
                      ->getRepository(Salle::class)
                      ->find($id);

        return $this->render('role/index.html.twig',[
                        'ticket' => $ticket,
                        // 'utilisateur' => $utilisateur,
                        'salle' => $salle
            ]);
    }
}
