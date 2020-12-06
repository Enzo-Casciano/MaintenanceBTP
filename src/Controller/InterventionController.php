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
use App\Form\InterventionType;
use App\Repository\InterventionRepository;
use App\Repository\StatutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InterventionController extends AbstractController
{

    public function index(Request $request, EntityManagerInterface $em, $id, StatutRepository $statutRep, InterventionRepository $interventionRep): Response
    {

        $em = $this->getDoctrine()->getManager();

        $intervention = new Intervention();

        $form = $this->createForm(InterventionType::class, $intervention);
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            $em->persist($intervention);
            $em->flush();

            return $this->redirectToRoute('resultat');
        }


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

        $criticite = $this->getDoctrine()
                         ->getRepository(Criticite::class)
                         ->find($id);
        $changementStatutEnCours = $statutRep->updateStatutTicket($id, 3);

        $updateInterventionTicket = $statutRep->updateInterventionTicket($id, $interventionRep->getInterventionTicket());

    return $this->render('intervention/index.html.twig',[
         'form' => $form->createView(),
         'criticite' => $criticite,
         'ticket' => $ticket,
         'utilisateur' => $utilisateur,
         'salle' => $salle,
         'statut' => $statut,
         'niveau' => $niveau,
         'zone' => $zone,
         'materiel' => $materiel,
         'changementStatutEnCours' => $changementStatutEnCours,
         'updateInterventionTicket' => $updateInterventionTicket
    ]);
}


}
