<?php
namespace App\Controller;

use App\Entity\User;
use App\Entity\Eleve;
use App\Entity\Responsable;
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
        if ($request->isMethod('POST')) {
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $email = $request->request->get('email');
            $plainPassword = $request->request->get('password');
            $confirmPassword = $request->request->get('confirm_password');
            $type = $request->request->get('type');

            // Récupération des informations d'adresse
            $numRue = $request->request->get('num_rue');
            $rue = $request->request->get('rue');
            $copos = $request->request->get('copos');
            $ville = $request->request->get('ville');
            $tel = $request->request->get('tel');

            // Vérification des mots de passe
            if ($plainPassword !== $confirmPassword) {
                $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
                return $this->redirectToRoute('app_register');
            }
            
            if (!in_array($type, ['eleve', 'responsable'])) {
                $this->addFlash('error', 'Veuillez choisir un type de compte.');
                return $this->redirectToRoute('app_register');
            }

            // Création de l'utilisateur
            $user = new User();
            $user->setEmail($email);
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setRoles(['ROLE_USER']);
            
            // Hachage du mot de passe (AVANT de persister)
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            // Enregistrement de l'utilisateur en base
            $entityManager->persist($user);
            $entityManager->flush();

            if ($type === 'eleve') {
                $eleve = new Eleve();
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setMail($email);
                $eleve->setUser($user);
                
                // Définir les valeurs avec des valeurs par défaut si null
                $eleve->setRue($rue !== '' ? (string)$rue : null);
                $eleve->setVille($ville !== '' ? (string)$ville: null);
                $eleve->setNumRue($numRue !== '' ? (int)$numRue : null);
                $eleve->setCopos($copos !== '' ? (int)$copos : null);
                $eleve->setTel($tel !== '' ? (int)$tel : null);


                
                $entityManager->persist($eleve);
            } elseif ($type === 'responsable') {
                $responsable = new Responsable();
                $responsable->setNom($nom);
                $responsable->setPrenom($prenom);
                $responsable->setUser($user);
                $entityManager->persist($responsable);

                $responsable->setNumRue($numRue ? (int)$numRue : 0);
                $responsable->setRue($rue ?? '');
                $responsable->setCopos($copos ? (int)$copos : 0);
                $responsable->setVille($ville ?? '');
                $responsable->setTel($tel ? (int)$tel : 0);
            }
            
            $entityManager->flush();

            // Message de confirmation
            $this->addFlash('success', 'Votre compte a été créé avec succès !');

            // Redirection vers la page de connexion
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig');
    }
}