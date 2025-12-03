<?php

namespace App\Form;

use App\Entity\Inscription;
use App\Entity\Paiment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaimentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('montant')
            ->add('datePaiment')
            ->add('inscription', EntityType::class, [
                'class' => Inscription::class,
            'choice_label' => function (Inscription $inscription){
                return $inscription->getEleve()->getNom(). ' ' . $inscription->getEleve()->getPrenom();
            },
            'multiple' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paiment::class,
        ]);
    }
}
