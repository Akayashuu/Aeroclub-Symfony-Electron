<?php

namespace App\Form;

use App\Entity\Instructeurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InsertInstrucType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['required' => true])
            ->add('prenom', TextType::class, ['required' => true])
            ->add('numCivil', NumberType::class, ['required' => true])
            ->add('tauxInstructeur', NumberType::class, ['required' => true])
            ->add('adresse', TextType::class, ['required' => true])
            ->add('codePostal', NumberType::class, ['required' => true])
            ->add('ville', TextType::class, ['required' => true])
            ->add('tel', NumberType::class, ['required' => true])
            ->add('fax', NumberType::class, ['required' => true])
            ->add('email', TextType::class, ['required' => true])
            ->add('numBadge', NumberType::class, ['required' => true])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Instructeurs::class,
        ]);
    }
}
