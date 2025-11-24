<?php

namespace App\Controller;

use App\Entity\TarifCours;
use App\Entity\TrancheQuotient;
use App\Entity\Cours;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse; // Nécessaire pour l'API
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
            ->findBy([], ['quotientMin' => 'ASC']);

        // 2. Récupérer tous les tarifs
        $tarifs = $entityManager->getRepository(TarifCours::class)->findAll();

        // 3. Organiser les données pour le template
        $tarifsParTranche = [];

        // Initialisation de la structure pour chaque tranche
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

    /**
     * Route API pour récupérer le tarif basé sur l'ID de la tranche et l'ID du type de cours.
     * Cette méthode est destinée à être appelée par JavaScript (Fetch API) pour le calcul automatique.
     */
    #[Route('/api/get-tarif/{trancheId}/{coursId}', name: 'api_get_tarif', methods: ['GET'])]
    public function getTarifApi(EntityManagerInterface $entityManager, int $trancheId, int $coursId): JsonResponse
    {
        // Recherche du tarif correspondant aux deux critères
        $tarif = $entityManager->getRepository(TarifCours::class)->findOneBy([
            // ASSUREZ-VOUS QUE CES NOMS DE PROPRIÉTÉS SONT CORRECTS DANS TarifCours
            'trancheQuotientId' => $trancheId, 
            'coursId' => $coursId,             
        ]);

        if (!$tarif) {
            // Retourne 0.00 si aucune correspondance n'est trouvée pour la combinaison
            return new JsonResponse(['montant' => 0.00, 'error' => 'Tarif non trouvé pour cette combinaison.'], Response::HTTP_NOT_FOUND);
        }
        
        // Supposons que getPrixFacture() retourne le montant
        $montant = $tarif->getPrixFacture(); 

        return new JsonResponse(['montant' => $montant]);
    }
}