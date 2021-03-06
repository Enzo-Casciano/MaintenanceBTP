<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Entity\Niveau;
use App\Entity\Salle;
use App\Entity\Ticket;
use App\Entity\Utilisateur;
use App\Entity\Zone;
use App\Form\SalleType;
use App\Form\TicketType;
use App\Form\ZoneType;
use App\Repository\StatutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Mailer\Bridge\Google\Smtp\GmailTransport;
use Symfony\Component\Mime\TemplatedEmail;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;

class TicketController extends AbstractController
{

    public function index(Request $request, EntityManagerInterface $em, StatutRepository $statutRep, MailerInterface $mailer): Response
    {
        $em = $this->getDoctrine()->getManager();

        // $statut = $statutRep->findAll();
        $niveau = new Niveau();
        $zone = new Zone();
        $salle = new Salle();
        $materiel = new Materiel();
        $ticket = new Ticket();
        $utilisateur = new Utilisateur();
        $utilisateur = $this->getUser();

        $ticket->setDateTicket(new \DateTime('now'));
        
        $statut = $statutRep->find(1);

        $zone->addNiveau($niveau);
        $salle->addZone($zone);
        $ticket->addSalle($salle);
        $ticket->addMateriel($materiel);
        $ticket->setUtilisateur($utilisateur);

        // $statutRep->updateStatutTicket(3, 1);

        $form = $this->createForm(TicketType::class, $ticket);
        $formSalle = $this->createForm(SalleType::class, $salle);
        $formZone = $this->createForm(ZoneType::class, $zone);
        
        $form->handleRequest($request);
        $formSalle->handleRequest($request);
        $formZone->handleRequest($request);

        if($form->isSubmitted()){
            // $ticket->getCriticite()->setNomCriticite("En attente");

            // $email = (new Email())
            //     ->from('test42@gmail.com') 
            //     ->to('antoine.bouchet72@outlook.fr')
            //     ->priority(Email::PRIORITY_HIGH) 
            //     ->subject('Nouvelle demande de ticket')
            //     // If you want use text mail only
            //         ->text('Lorem ipsum...') 
            //     // Raw html
            //         ->html('<h1>Lorem ipsum</h1> <p>...</p>')
            // ;
            // $mailer->send($email);


            $ticket->setStatut($statut);
            $em->persist($ticket);
            $em->flush();

            return $this->redirectToRoute('home');
        }


        return $this->render('demande/index.html.twig', [
            'form' => $form->createView(),
            'formSalle' => $formSalle->createView(),
            'formZone' => $formZone->createView()
        ]);
    }
}
