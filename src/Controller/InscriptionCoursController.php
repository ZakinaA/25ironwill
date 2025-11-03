<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Eleve;
use App\Entity\Cours;
use App\Entity\Responsable;
use App\Entity\Inscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class InscriptionCoursController extends AbstractController
{
   #[Route('/inscription_cours', name: 'app_inscription_cours')]
public function index(Request $request, EntityManagerInterface $em): Response
{
    $eleveId = $request->request->get('eleve');
    $coursIds = $request->request->all('cours'); 
    $responsableIds = $request->request->all('responsable');

    if ($request->isMethod('POST') && $eleveId && !empty($coursIds) && !empty($responsableIds)) {
        $eleve = $em->getRepository(Eleve::class)->find($eleveId);

        if ($eleve) {
            foreach ($coursIds as $coursId) {
                $cours = $em->getRepository(Cours::class)->find($coursId);
                if ($cours) {
                    $inscription = new Inscription();
                    $inscription->setEleve($eleve);
                    $inscription->setCours($cours);
                    $inscription->setResponsable($responsable);
                    $inscription->setDateInscription(new \DateTime());

                    $em->persist($inscription);
                }
            }

            $em->flush();
            $this->addFlash('success', 'Inscriptions réussies !');

            return $this->redirectToRoute('app_inscription_cours');
        }
    }

    return $this->render('inscription_cours/index.html.twig', [
        'eleves' => $em->getRepository(Eleve::class)->findAll(),
        'cours' => $em->getRepository(Cours::class)->findAll(),
        'responsable' => $em->getRepository(Responsable::class)->findAll(),
    ]);
}



}