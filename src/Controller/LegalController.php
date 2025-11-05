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
}
