<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionCoursController extends AbstractController
{
    #[Route('/inscription/cours', name: 'app_inscription_cours')]
    public function index(): Response
    {
        return $this->render('inscription_cours/index.html.twig', [
            'controller_name' => 'InscriptionCoursController',
        ]);
    }
}
