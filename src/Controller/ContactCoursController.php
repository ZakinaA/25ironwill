<?php

namespace App\Controller;

use App\Entity\ContactCours;
use App\Form\ContactCoursType; 
use App\Repository\ContactCoursRepository; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contactCours')] 
class ContactCoursController extends AbstractController
{
    #[Route('/', name: 'app_contact_cours_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $contacts = $entityManager->getRepository(ContactCours::class)->findAll();

        return $this->render('contact_cours/index.html.twig', [
            'demandes_cours' => $contacts,
        ]);
    }

    
    #[Route('/new', name: 'app_contact_cours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contactCours = new ContactCours();
        $form = $this->createForm(ContactCoursType::class, $contactCours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contactCours);
            $entityManager->flush();

            // MODIFICATION ICI : On change la redirection vers 'app_dashboard'
            // Assurez-vous que la route 'app_dashboard' existe bien dans un de vos contrôleurs
            return $this->redirectToRoute('app_dashboard'); 
        }

        return $this->render('contact_cours/new.html.twig', [
            'contact_cours' => $contactCours,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contact_cours_show', methods: ['GET'])]
    public function show(ContactCours $contactCours): Response
    {
        
        return $this->render('contact_cours/show.html.twig', [
            'contact_cours' => $contactCours,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_contact_cours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContactCours $contactCours, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(ContactCoursType::class, $contactCours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact_cours/edit.html.twig', [
            'contact_cours' => $contactCours,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contact_cours_delete', methods: ['POST'])]
    public function delete(Request $request, ContactCours $contactCours, EntityManagerInterface $entityManager): Response
    {

        if ($this->isCsrfTokenValid('delete'.$contactCours->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contactCours);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_contact_cours_index', [], Response::HTTP_SEE_OTHER);
    }
}