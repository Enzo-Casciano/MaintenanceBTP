<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ZoneController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('zone/index.html.twig', [
            'controller_name' => 'ZoneController',
        ]);
    }
}
