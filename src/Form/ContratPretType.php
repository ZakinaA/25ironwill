<?php

namespace App\Form;

use App\Entity\ContratPret;
use App\Entity\Eleve;
use App\Entity\Instrument;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ContratPretType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Liste déroulante des élèves
            ->add('eleve', EntityType::class, [
                'class' => Eleve::class,
                'choice_label' => function (Eleve $eleve) {
                    return $eleve->getNom() . ' ' . $eleve->getPrenom();
                },
                'label' => 'Élève emprunteur'
            ])
            // Liste déroulante des instruments
            ->add('instrument', EntityType::class, [
                'class' => Instrument::class,
                // Affiche le nom ou la marque + numéro de série
                'choice_label' => function (Instrument $inst) {
                    return $inst->getMarque()->getLibelle() . ' (' . $inst->getNumSerie() . ')'; 
                },
                'label' => 'Instrument à louer'
            ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début'
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin prévue'
            ])
            ->add('etatDetailleDebut', TextType::class, [
                'label' => 'État au départ (ex: Neuf, rayure sur le dos...)'
            ])
            // L'UPLOAD DE FICHIER
            ->add('attestationAssurance', FileType::class, [
                'label' => 'Attestation d\'assurance (PDF)',
                'mapped' => false, // Important : on gère ça manuellement
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Merci d\'uploader un PDF ou une image valide',
                    ])
                ],
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