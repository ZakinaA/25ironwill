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