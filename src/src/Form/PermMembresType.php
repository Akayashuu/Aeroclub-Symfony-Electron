<?php

namespace App\Form;

use App\Entity\Permissions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PermMembresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('isAdmin', CheckboxType::class, [
            'required' => false,
        ])
        ->add('canWrite', CheckboxType::class, [
            'required' => false,
        ])
        ->add('canRead', CheckboxType::class, [
            'required' => false,
        ])
        ->add('canUpdate', CheckboxType::class, [
            'required' => false,
        ])
        ->add('canDelete', CheckboxType::class, [
            'required' => false,
        ])
        ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Permissions::class,
        ]);
    }
}
