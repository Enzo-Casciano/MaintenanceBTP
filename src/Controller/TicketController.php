<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Entity\Niveau;
use App\Entity\Salle;
use App\Entity\Ticket;
use App\Entity\Zone;
use App\Form\SalleType;
use App\Form\TicketType;
use App\Form\ZoneType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $em = $this->getDoctrine()->getManager();

        $niveau = new Niveau();
        $zone = new Zone();
        $salle = new Salle();
        $materiel = new Materiel();
        $ticket = new Ticket();

        $ticket->setDateTicket(new \DateTime('now'));

        $zone->addNiveau($niveau);
        $salle->addZone($zone);
        $ticket->addSalle($salle);
        $ticket->addMateriel($materiel);

        $form = $this->createForm(TicketType::class, $ticket);
        $formSalle = $this->createForm(SalleType::class, $salle);
        $formZone = $this->createForm(ZoneType::class, $zone);
        
        $form->handleRequest($request);
        $formSalle->handleRequest($request);
        $formZone->handleRequest($request);
        
        if($form->isSubmitted()){
            $em->persist($ticket);
            $em->flush();

            // return $this->redirectToRoute('home');
        }


        return $this->render('ticket/index.html.twig', [
            'form' => $form->createView(),
            'formSalle' => $formSalle->createView(),
            'formZone' => $formZone->createView()
        ]);
    }
}
