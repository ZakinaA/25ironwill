<?php

namespace App\Controller;

use App\Entity\Paiment;
use App\Entity\Eleve;
use App\Entity\Responsable;
use App\Form\PaimentType;
use App\Repository\PaimentRepository;
use App\Repository\TarifCoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/paiment')]
class PaimentController extends AbstractController
{
    #[Route('/', name: 'app_paiment_index', methods: ['GET'])]
    public function index(PaimentRepository $paimentRepository, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $paiments = [];
        $isAdmin = $this->isGranted('ROLE_ADMIN');
        $isResponsable = $this->isGranted('ROLE_RESPONSABLE');

        // --- CAS 1 : ADMIN (Voit tout) ---
        if ($isAdmin) {
            $paiments = $paimentRepository->findAll();
        } 
        
        // --- CAS 2 : RESPONSABLE (Voit ses enfants) ---
        elseif ($isResponsable) {
            // On récupère la fiche Responsable liée au User
            $responsable = $em->getRepository(Responsable::class)->findOneBy(['user' => $user]);

            if ($responsable) {
                // On récupère la liste de SES élèves
                $mesEleves = $responsable->getEleve()->toArray(); 
                
                if (!empty($mesEleves)) {
                    // On cherche les paiements de ces élèves là uniquement
                    $paiments = $paimentRepository->findBy(['eleve' => $mesEleves]);
                }
            }
        } 
        
        // --- CAS 3 : ELEVE (Voit ses paiements) ---
        else {
            // On récupère la fiche Eleve liée au User
            $eleve = $em->getRepository(Eleve::class)->findOneBy(['user' => $user]);

            if ($eleve) {
                $paiments = $paimentRepository->findBy(['eleve' => $eleve]);
            }
        }

        return $this->render('paiment/index.html.twig', [
            'paiments' => $paiments,
            'isAdmin' => $isAdmin,
            'isResponsable' => $isResponsable,
        ]);
    }

    #[Route('/new', name: 'app_paiment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, TarifCoursRepository $tarifCoursRepository): Response
    {
        // Sécurité : Seul Admin ou Responsable peut créer un paiement manuel
        if (!$this->isGranted('ROLE_ADMIN') && !$this->isGranted('ROLE_RESPONSABLE')) {
            throw $this->createAccessDeniedException('Accès refusé.');
        }

        $paiment = new Paiment();
        $form = $this->createForm(PaimentType::class, $paiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $inscription = $paiment->getInscription();
            
            if ($inscription) {
                // Liaison automatique de l'élève
                $eleve = $inscription->getEleve();
                $paiment->setEleve($eleve);

                // --- CALCUL AUTOMATIQUE DU PRIX ---
                if ($paiment->getMontant() === null) {
                    
                    // On récupère le responsable de l'élève (le premier trouvé)
                    $responsable = $eleve->getResponsables()->first();

                    if ($responsable) {
                        $quotient = $responsable->getQuotient();
                        
                        if ($quotient) {
                            $paiment->setQuotient($quotient); // Sauvegarde du quotient

                            $cours = $inscription->getCours();
                            
                            // Vérification méthode getType() sur Cours
                            if (method_exists($cours, 'getType')) {
                                $typeCours = $cours->getType(); 

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
                                $paiment->setMontant(0);
                                $this->addFlash('danger', 'Erreur technique : Méthode getType introuvable sur l\'entité Cours.');
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
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Paiment $paiment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paiment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($paiment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_paiment_index', [], Response::HTTP_SEE_OTHER);
    }
}