<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        // Exemple simple sans formulaire Symfony (pour comprendre le mécanisme)
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $plainPassword = $request->request->get('password');

            // Création de l'utilisateur
            $user = new User();
            $user->setEmail($email);

            // Hachage du mot de passe
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            // Enregistrement en base
            $entityManager->persist($user);
            $entityManager->flush();

            // Message de confirmation
            $this->addFlash('success', 'Votre compte a été créé avec succès !');

            // Redirection vers la page de connexion
            return $this->redirectToRoute('app_login');
        }

        // Si c’est une requête GET, on affiche simplement le formulaire HTML
        return $this->render('registration/register.html.twig');
    }
}
