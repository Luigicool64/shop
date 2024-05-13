<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\TypeProduit;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModifierProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=>'fw-bold']])
        ->add('description',TextareaType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=>'fw-bold']])
        ->add('TypeProduit', EntityType::class, [
            'class' => TypeProduit::class,
            'choice_label' => 'type_produit',
            'label_attr' => ['class'=> 'fw-bold'],
            'attr' => ['autocomplete' => 'new-password','class'=> 'form-control',],
        ])
        ->add('Modifier', SubmitType::class,  ['attr' => ['class'=> 'btn bg-success text-white m-4' ],'row_attr' => ['class' => 'text-center'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
