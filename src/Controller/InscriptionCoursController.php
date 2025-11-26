<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Eleve;
use App\Entity\Cours;
use App\Entity\Responsable;
use App\Entity\Inscription;
use App\Entity\Paiment; 
use App\Repository\TarifCoursRepository; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class InscriptionCoursController extends AbstractController
{
    #[Route('/inscription_cours', name: 'app_inscription_cours')]
    public function index(Request $request, EntityManagerInterface $em, TarifCoursRepository $tarifCoursRepository): Response
    {
        $user = $this->getUser(); 
        $eleveConnecte = $em->getRepository(Eleve::class)->findOneBy(['user' => $user]);

        $eleveId = $request->request->get('eleve');
        $coursIds = $request->request->all('cours', []);

        if ($request->isMethod('POST') && $eleveId && !empty($coursIds)) {
            $eleveChoisi = $em->getRepository(Eleve::class)->find($eleveId);

            if ($eleveChoisi) {
                foreach ($coursIds as $coursId) {
                    $cours = $em->getRepository(Cours::class)->find($coursId);
                    
                    if ($cours) {
                        // 1. Création de l'inscription
                        $inscription = new Inscription();
                        $inscription->setEleve($eleveChoisi);
                        $inscription->setCours($cours);
                        $inscription->setDateInscription(new \DateTime());
                        $em->persist($inscription);

                        // 2. Création du Paiement
                        $paiment = new Paiment();
                        $paiment->setInscription($inscription);
                        $paiment->setEleve($eleveChoisi);
                        $paiment->setDatePaiment(new \DateTime());
                        
                        // 3. Calcul du Montant et Enregistrement du Quotient
                        $montantCalcule = 0;
                        $responsable = $eleveChoisi->getResponsables()->first(); 

                        if ($responsable) {
                            $quotient = $responsable->getQuotient();
                            
                            if ($quotient) {
                                // === C'EST ICI QU'IL MANQUAIT LA LIGNE ===
                                $paiment->setQuotient($quotient); 

                                if (method_exists($cours, 'getType')) {
                                    $tarif = $tarifCoursRepository->findOneBy([
                                        'tranche_quotient_id' => $quotient,
                                        'cours_id' => $cours->getType()
                                    ]);

                                    if ($tarif) {
                                        $montantCalcule = $tarif->getPrixFacture();
                                    }
                                }
                            }
                        }

                        $paiment->setMontant((float)$montantCalcule);
                        $em->persist($paiment);
                    }
                }

                $em->flush();
                $this->addFlash('success', 'Inscriptions validées et paiements générés !');

                return $this->redirectToRoute('app_inscription_cours');
            }
        }

        return $this->render('inscription_cours/index.html.twig', [
            'eleves' => $em->getRepository(Eleve::class)->findAll(),
            'cours' => $em->getRepository(Cours::class)->findAll(),
            'responsables' => $em->getRepository(Responsable::class)->findAll(),
            'eleve' => $eleveConnecte, 
        ]);
    }
}