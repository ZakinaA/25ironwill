<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Eleve;
use App\Entity\Cours;
use App\Entity\Inscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class InscriptionCoursController extends AbstractController
{
    #[Route('/inscription_cours', name: 'app_inscription_cours')]
public function index(Request $request, EntityManagerInterface $em): Response
{
    $eleveId = $request->request->get('eleve');
    $coursId = $request->request->get('cours');

    if ($request->isMethod('POST') && $eleveId && $coursId) {
        $eleve = $em->getRepository(Eleve::class)->find($eleveId);
        $cours = $em->getRepository(Cours::class)->find($coursId);

        if ($eleve && $cours) {
            $inscription = new Inscription();
            $inscription->setEleve($eleve);
            $inscription->setCours($cours);
            $inscription->setDateInscription(new \DateTime());

            $em->persist($inscription);
            $em->flush();

            $this->addFlash('success', 'Inscription réussie !');

            // 🔹 REDIRECTION pour éviter le double POST
            return $this->redirectToRoute('app_inscription_cours');
        }
    }

    return $this->render('inscription_cours/index.html.twig', [
        'eleves' => $em->getRepository(Eleve::class)->findAll(),
        'cours' => $em->getRepository(Cours::class)->findAll(),
    ]);
}


}