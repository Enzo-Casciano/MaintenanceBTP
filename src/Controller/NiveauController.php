<?php

namespace App\Controller;

use App\Entity\Niveau;
use App\Form\NiveauType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NiveauController extends AbstractController
{
    public function index(Request $request,EntityManagerInterface $em): Response
    {
        $em = $this->getDoctrine()->getManager();

        $niveau = new Niveau();

        $form = $this->createForm(NiveauType::class,$niveau);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $em->persist($niveau);
            $em->flush();
        }

        return $this->render('accueil/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
