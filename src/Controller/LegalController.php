<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalController extends AbstractController
{
    #[Route('/mentions-legales', name: 'app_mentions_legales')]
    #[Route('/cookies', name: 'app_cookies')]
    public function index(Request $request): Response
    {
        // Récupère la route actuelle depuis la Request
        $route = $request->attributes->get('_route');

        return $this->render('legal/index.html.twig', [
            'current_route' => $route
        ]);
    }
    #[Route('/mentions-legales-accueil', name: 'app_mentions_legales_accueil')]
        public function legal(Request $request): Response
    {
        $route = $request->attributes->get('_route');

        return $this->render('accueil/legal.html.twig', [
            'current_route' => $route
        ]);
    }
    #[Route('/cookie-accueil', name: 'app_cookies_accueil')]
     public function cookiesAccueil(Request $request): Response
    {
        $route = $request->attributes->get('_route');

        return $this->render('accueil/legal.html.twig', [
            'current_route' => $route
        ]);
    }
}
