<?php

namespace App\Controller;

use App\Entity\TarifCours;
use App\Entity\TrancheQuotient;
use App\Entity\Cours;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')] 
class TarifCoursController extends AbstractController
{
    #[Route('/tarif', name: 'app_tarif_cours', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // 1. Récupérer toutes les tranches triées par quotient minimum
        // CORRECTION : Utiliser le nom de la propriété PHP (avec underscore)
        $tranches = $entityManager->getRepository(TrancheQuotient::class)
            ->findBy([], ['quotient_min' => 'ASC']);

        // 2. Récupérer tous les tarifs
        $tarifs = $entityManager->getRepository(TarifCours::class)->findAll();

        // 3. Organiser les données pour le template
        $tarifsParTranche = [];

        // Initialisation de la structure pour chaque tranche
        foreach ($tranches as $tranche) {
            $trancheId = $tranche->getId();
            
            $tarifsParTranche[$trancheId] = [
                'nom' => $tranche->getNomTranche(),
                'min' => $tranche->getQuotientMin(),
                'max' => $tranche->getQuotientMax(),
                'prix_individuel' => null,
                'prix_collectif' => null,
            ];
        }

        // Remplissage des prix selon le type de cours
        foreach ($tarifs as $tarif) {
            // Récupération des relations
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

        return $this->render('tarif_cours/index.html.twig', [
            'controller_name' => 'TarifCoursController',
            'tarifs_par_tranche' => $tarifsParTranche,
        ]);
    }
}