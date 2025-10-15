<?php

namespace App\Form;

use App\Entity\Instrument;
use App\Entity\Intervention;
use App\Entity\professionnel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut')
            ->add('dateFin')
            ->add('description')
            ->add('prix')
            ->add('quotite')
            ->add('professionnel', EntityType::class, [
                'class' => professionnel::class,
'choice_label' => 'id',
            ])
            ->add('instrument', EntityType::class, [
                'class' => Instrument::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervention::class,
        ]);
    }
}
