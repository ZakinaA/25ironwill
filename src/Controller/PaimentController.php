<?php

namespace App\Controller;

use App\Entity\Paiment;
use App\Form\PaimentType;
use App\Repository\PaimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Repository\TarifCoursRepository;

#[Route('/paiment')]
class PaimentController extends AbstractController
{
    #[Route('/', name: 'app_paiment_index', methods: ['GET'])]
    public function index(PaimentRepository $paimentRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifie si l'utilisateur est Admin ou Responsable
        $isManager = $this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_RESPONSABLE');

        if ($isManager) {
            $paiments = $paimentRepository->findAll();
        } else {
            // Pour l'élève connecté, on affiche ses paiements
            $paiments = $paimentRepository->findBy(['eleve' => $user]);
        }

        return $this->render('paiment/index.html.twig', [
            'paiments' => $paiments,
            'isAdmin' => $isManager,
        ]);
    }

    #[Route('/new', name: 'app_paiment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, TarifCoursRepository $tarifCoursRepository): Response
    {
        // CORRECTION SÉCURITÉ : On vérifie manuellement ici pour éviter l'erreur de syntaxe
        if (!$this->isGranted('ROLE_ADMIN') && !$this->isGranted('ROLE_RESPONSABLE')) {
            throw $this->createAccessDeniedException('Accès refusé.');
        }

        $paiment = new Paiment();
        $form = $this->createForm(PaimentType::class, $paiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // 1. On récupère l'inscription choisie
            $inscription = $paiment->getInscription();
            
            if ($inscription) {
                // On remplit automatiquement l'élève
                $eleve = $inscription->getEleve();
                $paiment->setEleve($eleve);

                // --- CALCUL AUTOMATIQUE DU PRIX ---
                // On ne calcule que si le montant n'a pas été forcé manuellement
                if ($paiment->getMontant() === null) {
                    
                    // A. On récupère LE responsable (le premier trouvé dans la liste)
                    // Note: Compatible avec ta relation ManyToMany (Collection)
                    $responsable = $eleve->getResponsables()->first();

                    if ($responsable) {
                        // On récupère son quotient
                        $quotient = $responsable->getQuotient();
                        
                        if ($quotient) {
                            $paiment->setQuotient($quotient); // On enregistre le quotient utilisé

                            // B. On récupère le cours et son TYPE
                            $cours = $inscription->getCours();
                            
                            // HYPOTHÈSE : Ton entité Cours a une méthode getType()
                            // Si cette méthode n'existe pas, cela affichera une erreur claire.
                            if (method_exists($cours, 'getType')) {
                                $typeCours = $cours->getType(); 

                                // C. On cherche le tarif dans la grille
                                $tarifOfficiel = $tarifCoursRepository->findOneBy([
                                    'tranche_quotient_id' => $quotient,
                                    'cours_id' => $typeCours 
                                ]);

                                if ($tarifOfficiel) {
                                    $paiment->setMontant($tarifOfficiel->getPrixFacture());
                                    $this->addFlash('success', 'Tarif calculé : ' . $tarifOfficiel->getPrixFacture() . ' €');
                                } else {
                                    $paiment->setMontant(0);
                                    $this->addFlash('warning', 'Aucun tarif trouvé pour ce cours et ce quotient.');
                                }
                            } else {
                                // Sécurité si la méthode getType n'est pas trouvée
                                $paiment->setMontant(0);
                                $this->addFlash('danger', 'Erreur technique : Impossible de récupérer le Type du cours (méthode getType introuvable).');
                            }

                        } else {
                            $paiment->setMontant(0);
                            $this->addFlash('warning', 'Le responsable n\'a pas de quotient familial défini.');
                        }
                    } else {
                        $paiment->setMontant(0);
                        $this->addFlash('danger', 'Cet élève n\'a aucun responsable associé.');
                    }
                }
            }

            $entityManager->persist($paiment);
            $entityManager->flush();

            return $this->redirectToRoute('app_paiment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('paiment/new.html.twig', [
            'paiment' => $paiment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paiment_show', methods: ['GET'])]
    public function show(Paiment $paiment): Response
    {
        return $this->render('paiment/show.html.twig', [
            'paiment' => $paiment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_paiment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Paiment $paiment, EntityManagerInterface $entityManager): Response
    {
        // CORRECTION SÉCURITÉ : Vérification manuelle
        if (!$this->isGranted('ROLE_ADMIN') && !$this->isGranted('ROLE_RESPONSABLE')) {
            throw $this->createAccessDeniedException('Accès refusé.');
        }

        $form = $this->createForm(PaimentType::class, $paiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_paiment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('paiment/edit.html.twig', [
            'paiment' => $paiment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paiment_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')] // Seul l'admin peut supprimer
    public function delete(Request $request, Paiment $paiment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paiment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($paiment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_paiment_index', [], Response::HTTP_SEE_OTHER);
    }
}