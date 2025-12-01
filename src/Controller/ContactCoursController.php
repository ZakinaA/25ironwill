<?php

namespace App\Controller;

use App\Entity\ContactCours;
use App\Form\ContactCoursType; // ATTENTION : Assure-toi que ce formulaire existe, sinon mets Contact1Type
use App\Repository\ContactCoursRepository; // Si ce repository n'existe pas, supprime cette ligne
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contactCours')] // J'ai mis un chemin plus propre
class ContactCoursController extends AbstractController
{
    #[Route('/', name: 'app_contact_cours_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // CORRECTION : On cherche dans la table ContactCours
        $contacts = $entityManager->getRepository(ContactCours::class)->findAll();

        return $this->render('contact_cours/index.html.twig', [
            // On renomme la variable pour être clair (pense à mettre 'demandes_cours' dans ton Twig aussi)
            'demandes_cours' => $contacts,
        ]);
    }

    #[Route('/new', name: 'app_contact_cours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // CORRECTION : On crée un objet ContactCours
        $contactCours = new ContactCours();
        
        // CORRECTION : Utilise le formulaire dédié aux cours
        // Si tu n'as pas créé ContactCoursType, remets Contact1Type::class ici
        $form = $this->createForm(ContactCoursType::class, $contactCours);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contactCours);
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact_cours/new.html.twig', [
            'contact_cours' => $contactCours,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contact_cours_show', methods: ['GET'])]
    public function show(ContactCours $contactCours): Response
    {
        // CORRECTION : Type-hinting ContactCours pour que Symfony trouve le bon
        return $this->render('contact_cours/show.html.twig', [
            'contact_cours' => $contactCours,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_contact_cours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContactCours $contactCours, EntityManagerInterface $entityManager): Response
    {
        // Si tu n'as pas ContactCoursType, remets Contact1Type::class
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
        // CORRECTION : Nom du token unique pour éviter les conflits
        if ($this->isCsrfTokenValid('delete'.$contactCours->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contactCours);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_contact_cours_index', [], Response::HTTP_SEE_OTHER);
    }
}