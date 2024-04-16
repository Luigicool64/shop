<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Rechercher', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=>'fw-bold']])
            ->add('ajouter', SubmitType::class,  ['attr' => ['class'=> 'btn bg-success text-white m-4' ],'row_attr' => ['class' => 'text-center'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
