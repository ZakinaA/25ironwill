<?php

namespace App\Controller;

use App\Entity\ContratPret;
use App\Form\ContratPretType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/contrat/pret', name: 'app_contrat_pret_')]
class ContratPretController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // On récupère tous les contrats pour les afficher dans la liste
        $contrats = $entityManager->getRepository(ContratPret::class)->findAll();

        return $this->render('contrat_pret/index.html.twig', [
            'contrat_prets' => $contrats,
        ]);
    }

    #[Route('/nouveau', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $contrat = new ContratPret();
        
        // Initialisation des valeurs par défaut
        $contrat->setDateDebut(new \DateTime());
        $contrat->setEtatDetailleRetour('TBD'); 

        $form = $this->createForm(ContratPretType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // --- GESTION DU FICHIER (Attestation) ---
            /** @var UploadedFile $file */
            $file = $form->get('attestationAssurance')->getData();

            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // Sécurisation du nom de fichier
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                try {
                    // Déplace le fichier dans le dossier public/uploads/attestations
                    $file->move(
                        $this->getParameter('kernel.project_dir').'/public/uploads/attestations',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Tu peux ajouter un message flash ici en cas d'erreur
                }

                // On sauvegarde seulement le nom du fichier en BDD
                $contrat->setAttestationAssurance($newFilename);
            }
            // ----------------------------------------

            $entityManager->persist($contrat);
            $entityManager->flush();

            return $this->redirectToRoute('app_contrat_pret_index');
        }

        return $this->render('contrat_pret/new.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }
}