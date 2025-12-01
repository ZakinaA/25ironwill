<?php

namespace App\Form;

use App\Entity\ContactCours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactCoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Assurez-vous que ces noms ('nom', 'email', 'message') 
            // correspondent EXACTEMENT aux propriétés dans votre entité src/Entity/ContactCours.php
            ->add('nom', TextType::class, [
                'label' => 'Votre Nom',
                'attr' => ['placeholder' => 'Entrez votre nom']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre Email',
                'attr' => ['placeholder' => 'exemple@email.com']
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre Message',
                'attr' => ['rows' => 5, 'placeholder' => 'Écrivez votre message ici...']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactCours::class,
        ]);
    }
}