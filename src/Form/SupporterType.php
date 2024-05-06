<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\Support;
use App\Entity\Supporter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SupporterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prix', NumberType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=>'fw-bold']])
            ->add('stock', NumberType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=>'fw-bold']])
            ->add('produit', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'nom',
                'label_attr' => ['class'=> 'fw-bold'],
                'attr' => ['autocomplete' => 'new-password','class'=> 'form-control',],
            ])
            ->add('Support', EntityType::class, [
                'class' => Support::class,
                'choice_label' => 'nom',
                'label_attr' => ['class'=> 'fw-bold'],
                'attr' => ['autocomplete' => 'new-password','class'=> 'form-control',],
            ])
            ->add('ajouter', SubmitType::class,  ['attr' => ['class'=> 'btn bg-success text-white m-4' ],'row_attr' => ['class' => 'text-center'],])
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Supporter::class,
        ]);
    }
}
