<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function accueil(): Response
    {
        return $this->render('accueil/accueil.html.twig', [
            'title' => 'Bienvenue',
        ]);
    }

    #[Route('/accueil-cours', name: 'app_accueil_cours', methods: ['GET'])]
    public function cours(CoursRepository $coursRepository): Response
    {
        return $this->render('accueil/cours.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }
}
