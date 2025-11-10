<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Repository\EleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(
        EleveRepository $eleveRepository,
        EntityManagerInterface $entityManager
    ): Response
    {
        $eleves = $eleveRepository->findAll(); // récupère tous les élèves
        $eleve = $entityManager->getRepository(Eleve::class)->findOneBy(['user' => $this->getUser()]);

        // Récupérer tous les cours via les inscriptions
        $coursList = $eleve->getInscriptions()->map(function($inscription) {
            return $inscription->getCours();
        });
        
        
        return $this->render('dashboard/index.html.twig', [
            'eleves' => $eleves,
            'eleve' => $eleve,
            'coursList' => $coursList,
        ]);
    }
}