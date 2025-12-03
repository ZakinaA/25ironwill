<?php

namespace App\Form;

use App\Entity\Eleve;
use App\Entity\Responsable;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('numRue')
            ->add('rue')
            ->add('copos')
            ->add('ville')
            ->add('tel')
            ->add('mail')
            ->add('responsables', EntityType::class, [
                'class' => Responsable::class,
            'choice_label' => function (Responsable $responsable) {
            
            return $responsable->getNom() . ' ' . $responsable->getPrenom(); 
        },
        'multiple' => true,
    ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}
