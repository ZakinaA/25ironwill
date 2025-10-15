<?php

namespace App\Controller;

use App\Repository\EleveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(EleveRepository $eleveRepository): Response
    {
        $eleves = $eleveRepository->findAll(); // récupère tous les élèves

        return $this->render('home/index.html.twig', [
            'controller_name' => 'Page d\'Accueil',
            'eleves' => $eleves, // passe la variable au template
        ]);
    }
}
