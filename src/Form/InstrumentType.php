<?php

namespace App\Form;

use App\Entity\Couleur;
use App\Entity\Instrument;
use App\Entity\Marque;
use App\Entity\TypeInstrument;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstrumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numSerie')
            ->add('dateAchat')
            ->add('prixAchat')
            ->add('utilisation')
            ->add('cheminImage')
            ->add('marque', EntityType::class, [
                'class' => Marque::class,
'choice_label' => 'id',
            ])
            ->add('type', EntityType::class, [
                'class' => TypeInstrument::class,
'choice_label' => 'id',
            ])
            ->add('couleurs', EntityType::class, [
                'class' => Couleur::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Instrument::class,
        ]);
    }
}
