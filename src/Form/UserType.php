<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
// AJOUTEZ CES DEUX LIGNES IMPORTANTES :
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Eleve' => 'ROLE_ELEVE',
                    'Responsable' => 'ROLE_RESPONSABLE',
                    'Administrateur' => 'ROLE_ADMIN',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('nom')
            ->add('prenom')
            ->add('numRue')
            ->add('rue')
            ->add('copos')
            ->add('ville')
            ->add('tel');

        // --- C'EST ICI QUE LA MAGIE OPÈRE ---
        // On écoute l'événement "PRE_SET_DATA" (avant de remplir le formulaire)
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $user = $event->getData();
            $form = $event->getForm();

            // Si l'utilisateur est null (nouveau) ou n'a pas d'ID (nouveau)
            // ALORS on ajoute le champ mot de passe
            if (!$user || null === $user->getId()) {
                $form->add('plainPassword', PasswordType::class, [
                    'label' => 'Mot de passe',
                    'mapped' => false,
                    'required' => true, // On peut le mettre en required ici car c'est une création
                    'attr' => ['autocomplete' => 'new-password', 'class' => 'form-control'],
                ]);
            }
        });
        // ------------------------------------
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}