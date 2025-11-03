<?php

namespace App\Controller;

use App\Repository\EleveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(EleveRepository $eleveRepository): Response
    {
        $eleves = $eleveRepository->findAll(); // récupère tous les élèves

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'Page d\'Accueil',
            'eleves' => $eleves, // passe la variable au template
        ]);
    }
}
