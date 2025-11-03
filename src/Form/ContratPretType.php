<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\ContratPret;
use App\Entity\Eleve;
use App\Entity\Instrument;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContratPretType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
            ])

            ->add('attestationAssurance', TextType::class, [
                'label' => 'Numéro police assurance',
            ])

            ->add('etatDetailleDebut', TextareaType::class, [
                'label' => "État initial de l'instrument",
            ])
            ->add('etatDetailleRetour', TextareaType::class, [
                'label' => "État de retour",
                'required' => false, // car au moment de l'ajout, le retour n’existe pas encore
            ])

            ->add('eleve', EntityType::class, [
                'class' => Eleve::class,
                'choice_label' => function(Eleve $eleve) {
                    return $eleve->getNom() . ' ' . $eleve->getPrenom();
                },
                'placeholder' => 'Sélectionner un élève',
            ])

            ->add('instrument', EntityType::class, [
                'class' => Instrument::class,
                'choice_label' => function(Instrument $instrument) {
                    return $instrument->getMarque()->getLibelle() . ' - ' . $instrument->getNumSerie();
                },
                'placeholder' => 'Sélectionner un instrument',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContratPret::class,
        ]);
    }
}
