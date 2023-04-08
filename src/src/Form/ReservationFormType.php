<?php

namespace App\Form;

use App\Entity\Avions;
use App\Entity\Membres;
use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ReservationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('scheduledAt', DateTimeType::class, [
                'required' => true,
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('endAt', DateTimeType::class, [
                'required' => true,
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('numMembres', EntityType::class, [
                'class' => Membres::class,
                'choice_label' => 'nom', 
                'required' => true
            ])
            ->add('numavions', EntityType::class, [
                'class' => Avions::class,
                'choice_label' => 'typeAvion', 
                'required' => true
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
