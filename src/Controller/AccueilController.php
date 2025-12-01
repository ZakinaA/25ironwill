<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Marque;
use App\Form\CoursType;
use App\Form\TypeInstrument;
use App\Repository\TypeInstrumentRepository;
use App\Repository\CoursRepository;
use App\Repository\MarqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\InstrumentRepository;
use App\Repository\TarifCoursRepository;
use App\Entity\TrancheQuotient;
use App\Entity\TarifCours;
use App\Repository\MarqueRepository;



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

    #[Route('/accueil-tarif', name: 'app_accueil_tarif', methods: ['GET'])]
    public function tarif(TarifCoursRepository $tarifCoursRepository, EntityManagerInterface $entityManager): Response
    {

        $tranches = $entityManager->getRepository(TrancheQuotient::class)
            ->findBy([], ['quotientMin' => 'ASC']);


        $tarifs = $entityManager->getRepository(TarifCours::class)->findAll();

        $tarifsParTranche = [];

        foreach ($tranches as $tranche) {
            $trancheId = $tranche->getId();
            
            $tarifsParTranche[$trancheId] = [
                'nom' => $tranche->getLibelle(),
                'min' => $tranche->getQuotientMin(),
                'max' => $tranche->getQuotientMax(),
                'prix_individuel' => null,
                'prix_collectif' => null,
            ];
        }


        foreach ($tarifs as $tarif) {
            $tranche = $tarif->getTrancheQuotientId(); // Basé sur votre entité TarifCours
            $cours = $tarif->getCoursId(); // À adapter selon votre entité TarifCours
            
            if ($tranche && $cours) {
                $trancheId = $tranche->getId();
                $coursId = $cours->getId();
                $prix = $tarif->getPrixFacture();

                if (isset($tarifsParTranche[$trancheId])) {
                    if ($coursId == 1) { // Cours Individuel
                        $tarifsParTranche[$trancheId]['prix_individuel'] = $prix;
                    } elseif ($coursId == 2) { // Cours Collectif
                        $tarifsParTranche[$trancheId]['prix_collectif'] = $prix;
                    }
                }
            }
        }

        return $this->render('accueil/tarif.html.twig', [
            'controller_name' => 'TarifCoursController',
            'tarifs_par_tranche' => $tarifsParTranche,
        ]);
    }

    #[Route('/{id}', name: 'app_cours_show_accueil', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Cours $cour): Response
    {
        return $this->render('accueil/showCours.html.twig', [
            'cour' => $cour,
        ]);
    }


    
    #[Route('/accueil-instrument', name: 'app_accueil_instrument', methods: ['GET'])]

    public function instrument(instrumentRepository $instrumentRepository, MarqueRepository $marqueRepository, TypeInstrumentRepository $typeInstrumentRepository): Response
    {
        $marques = $marqueRepository->findAll();
        $typeInstruments = $typeInstrumentRepository->findAll();
        
        return $this->render('accueil/instrument.html.twig', [
            'instruments' => $instrumentRepository->findAll(),
            'marques' => $marqueRepository->findAll(),

             'marques' => $marques, 
             'typeInstruments'=> $typeInstruments, main
        ]);
    }
    
 
    #[Route('/acceuil-contact', name: 'app_acceuil_contact')]
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
    $contact = new Contact();
    $form = $this->createForm(ContactType::class, $contact);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($contact);
        $em->flush();

        $this->addFlash('success', 'Votre message a bien été envoyé !');
        return $this->redirectToRoute('app_acceuil_contact');
    }

    return $this->render('accueil/contact.html.twig', [
        'form' => $form->createView(),
    ]);
}
}
