<?php

namespace App\Form;

use App\Entity\Membres;
use App\Entity\Badge;
use App\Entity\Qualif;
use Symfony\Bridge\Doctrine\Form\Type\EntityType as TypeEntityType;
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
            ->add('numBadge',  NumberType::class, ['required' => true])
            ->add('numQualif',  NumberType::class, ['required' => true])
            ->add('profession',  TextType::class, ['required' => true])
            ->add('lieuNaissance',  TextType::class, ['required' => true])
            ->add('carteFederal',  TextType::class, ['required' => true])
            ->add('dateNaissance',  DateType::class, ['required' => true])
            ->add('dateAttestation',  DateType::class, ['required' => true])
            ->add('dateTheoriqueBB',  DateType::class, ['required' => true])
            ->add('dateTheoriquePPLA',  DateType::class, ['required' => true])
            ->add('dateBB',  DateType::class, ['required' => true])
            ->add('datePPLA',  DateType::class, ['required' => true])
            ->add('numeroBB',  TextType::class, ['required' => true])
            ->add('numeroPPLA',  TextType::class, ['required' => true])
            ->add('dateInscription',  DateType::class, ['required' => true])
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
