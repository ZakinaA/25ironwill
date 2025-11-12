<?php

namespace App\Controller;

use App\Entity\Instrument;
use App\Entity\Marque;
use App\Entity\TypeInstrument;
use App\Form\InstrumentType;
use App\Repository\InstrumentRepository;
use App\Repository\MarqueRepository;
use App\Repository\TypeInstrumentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/instrument')]
class InstrumentController extends AbstractController
{
    #[Route('/', name: 'app_instrument_index')]
    public function index(Request $request, EntityManagerInterface $em, InstrumentRepository $instrumentRepository, MarqueRepository $marqueRepository, TypeInstrumentRepository $typeRepository): Response
    {
        if ($request->isMethod('POST')) {
            $marqueId = $request->request->get('marque');
            $typeId = $request->request->get('type');
            $numSerie = $request->request->get('numSerie');
            $dateAchat = $request->request->get('dateAchat');
            $prixAchat = $request->request->get('prixAchat');
            $utilisation = $request->request->get('utilisation');

            $photoFile = $request->files->get('photo');

            if ($marqueId && $typeId && $numSerie && $dateAchat && $prixAchat) {
                $instrument = new Instrument();

                $marque = $em->getRepository(Marque::class)->find($marqueId);
                $type = $em->getRepository(TypeInstrument::class)->find($typeId);

                $instrument->setMarque($marque);
                $instrument->setType($type);
                $instrument->setNumSerie($numSerie);
                $instrument->setDateAchat(new \DateTime($dateAchat));
                $instrument->setPrixAchat($prixAchat);
                $instrument->setUtilisation($utilisation);

                if ($photoFile) {
                    $fileName = uniqid() . '.' . $photoFile->guessExtension();
                    $photoFile->move($this->getParameter('instruments_images_dir'), $fileName);
                    $instrument->setCheminImage($fileName);
                }

                $em->persist($instrument);
                $em->flush();

                $this->addFlash('success', 'Instrument ajouté avec succès !');
                return $this->redirectToRoute('app_instrument_index');
            }
        }

        return $this->render('instrument/index.html.twig', [
            'instruments' => $instrumentRepository->findAll(),
            'marques' => $marqueRepository->findAll(),
            'typeInstruments' => $typeRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_instrument_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $instrument = new Instrument();
        $form = $this->createForm(InstrumentType::class, $instrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($instrument);
            $entityManager->flush();

            return $this->redirectToRoute('app_instrument_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('instrument/new.html.twig', [
            'instrument' => $instrument,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_instrument_show', methods: ['GET'])]
    public function show(Instrument $instrument): Response
    {
        return $this->render('instrument/show.html.twig', [
            'instrument' => $instrument,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_instrument_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Instrument $instrument, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InstrumentType::class, $instrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_instrument_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('instrument/edit.html.twig', [
            'instrument' => $instrument,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_instrument_delete', methods: ['POST'])]
    public function delete(Request $request, Instrument $instrument, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$instrument->getId(), $request->request->get('_token'))) {
            $entityManager->remove($instrument);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_instrument_index', [], Response::HTTP_SEE_OTHER);
    }
}
