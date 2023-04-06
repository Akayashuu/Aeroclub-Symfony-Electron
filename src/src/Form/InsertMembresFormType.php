<?php

namespace App\Form;

use App\Entity\Membres;
use App\Entity\Badge;
use App\Entity\Qualif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class InsertMembresFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',  TextType::class, ['required' => true])
            ->add('prenom',  TextType::class, ['required' => true])
            ->add('adresse',  TextType::class, ['required' => true])
            ->add('codePostal',  NumberType::class, ['required' => true])
            ->add('ville',  TextType::class, ['required' => true])
            ->add('tel',  NumberType::class, ['required' => true])
            ->add('fax',  NumberType::class, ['required' => true])
            ->add('email',  TextType::class, ['required' => true])
            ->add('numBadge', EntityType::class, [
                'class' => Badge::class,
                'choice_label' => 'numBadge', 
                'required' => true
            ])
            ->add('numQualif', EntityType::class, [
                'class' => Qualif::class,
                'choice_label' => 'numQualif', 
                'required' => true
            ])
            ->add('profession',  TextType::class, ['required' => true])
            ->add('lieuNaissance',  TextType::class, ['required' => true])
            ->add('carteFederal',  TextType::class, ['required' => true])
            ->add('dateNaissance',  DateType::class, [
                'required' => true,
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'class' => 'input',
                    'type' => 'date',
                    'placeholder' => 'Date De Naissance'
                ]
            ])
            ->add('dateAttestation',  DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'class' => 'input',
                    'type' => 'date',
                    'placeholder' => 'Date D\'Attestation'
                ]
            ])
            ->add('dateTheoriqueBB',  DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'class' => 'input',
                    'type' => 'date',
                    'placeholder' => 'Date Théorique du BB'
                ]
            ])
            ->add('dateTheoriquePPLA', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5' => true,
                'attr' => [
                    'class' => 'input',
                    'type' => 'date',
                    'placeholder' => 'Date Théorique du PPLA'
                ]
            ])
            ->add('dateBB',  DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'class' => 'input',
                    'type' => 'date',
                    'placeholder' => 'Date du BB'
                ]
            ])
            ->add('datePPLA',  DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'class' => 'input',
                    'type' => 'date',
                    'placeholder' => 'Date du PPLA'
                ]
            ])
            ->add('numeroBB',  TextType::class, ['required' => true])
            ->add('numeroPPLA',  TextType::class, ['required' => true])
            ->add('password',  TextType::class, ['required' => true])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membres::class,
        ]);
    }
}
