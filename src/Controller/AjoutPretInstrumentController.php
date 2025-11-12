<?php

namespace App\Controller;

use App\Entity\ContratPret;
use App\Form\ContratPretType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AjoutPretInstrumentController extends AbstractController
{
    #[Route('/AjoutPretInstrument', name: 'app_ajout_pret_instrument')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $contrat = new ContratPret();

        $form = $this->createForm(ContratPretType::class, $contrat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($contrat);
            $em->flush();

            $this->addFlash('success', 'Contrat ajouté avec succès !');

            return $this->redirectToRoute('app_ajout_pret_instrument'); 
        }
        return $this->render('ajout_pret_instrument/index.html.twig', [
            'form' => $form->createView(),
        ]);

        
    }
}
