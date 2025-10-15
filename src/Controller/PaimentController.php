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

#[Route('/paiment')]
class PaimentController extends AbstractController
{
    #[Route('/', name: 'app_paiment_index', methods: ['GET'])]
    public function index(PaimentRepository $paimentRepository): Response
    {
        return $this->render('paiment/index.html.twig', [
            'paiments' => $paimentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_paiment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $paiment = new Paiment();
        $form = $this->createForm(PaimentType::class, $paiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
    public function delete(Request $request, Paiment $paiment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paiment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($paiment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_paiment_index', [], Response::HTTP_SEE_OTHER);
    }
}
