<?php

namespace App\Form;

use App\Entity\Avions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class InsertAvionsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_avion',  TextType::class, ['required' => true])
            ->add('taux', NumberType::class, ['required' => true])
            ->add('forfait1', NumberType::class, ['required' => true])
            ->add('forfait2', NumberType::class, ['required' => true])
            ->add('forfait3', NumberType::class, ['required' => true])
            ->add('heures_forfait1', NumberType::class, ['required' => true])
            ->add('heures_forfait2', NumberType::class, ['required' => true])
            ->add('heures_forfait3', NumberType::class, ['required' => true])
            ->add('reduction_semaine', NumberType::class, ['required' => true])
            ->add('immatriculation',  TextType::class, ['required' => true])
            ->add('image',  TextType::class, ['required' => true])
            ->add('name',  TextType::class, ['required' => true])
            ->add('description',  TextType::class, ['required' => true])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avions::class,
        ]);
    }
}
