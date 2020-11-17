<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NiveauController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('niveau/index.html.twig', [
            'controller_name' => 'NiveauController',
        ]);
    }
}
