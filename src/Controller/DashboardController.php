<?php
namespace App\Controller;

use App\Entity\Eleve;
use App\Entity\Responsable;
use App\Repository\EleveRepository;
use App\Repository\ResponsableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(
        EleveRepository $eleveRepository,
        ResponsableRepository $responsableRepository
    ): Response
    {
        $user = $this->getUser();
        
        // Vérifier si l'utilisateur est connecté
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Récupérer l'élève ou le responsable selon le rôle
        $eleve = $eleveRepository->findOneBy(['user' => $user]);
        $responsable = $responsableRepository->findOneBy(['user' => $user]);
        
        $coursList = [];
        
        // Si c'est un élève, récupérer ses cours
        if ($eleve) {
            $coursList = $eleve->getInscriptions()->map(function($inscription) {
                return $inscription->getCours();
            });
        }
        
        /*
        $elevesResponsable = [];
        if ($responsable) {
            $elevesResponsable = $responsable->getEleves();
        }
        */
        return $this->render('dashboard/index.html.twig', [
            'eleve' => $eleve,
            'coursList' => $coursList,
            'responsable' => $responsable,
            //'elevesResponsable' => $elevesResponsable,
        ]);
    }
}