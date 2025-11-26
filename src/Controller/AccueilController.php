<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\InstrumentRepository;



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
    public function tarif(tarifRepository $tarifRepository): Response
    {
        return $this->render('accueil/tarif.html.twig', [
            'tarif' => $tarifRepository->findAll(),
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
    public function instrument(instrumentRepository $instrumentRepository): Response
    {
        return $this->render('accueil/instrument.html.twig', [
            'instruments' => $instrumentRepository->findAll(),
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