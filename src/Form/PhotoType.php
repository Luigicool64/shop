<?php

namespace App\Form;

use App\Entity\Photo;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', FileType::class, array('label' => 'Fichier à télécharger'), ['attr' => ['class'=> 'btn bg-success text-white m-4' ],'row_attr' => ['class' => 'text-center'],])
            ->add('produit', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'nom',
                'label_attr' => ['class'=> 'fw-bold'],
                'attr' => ['autocomplete' => 'new-password','class'=> 'form-control',]
            ])
            ->add('ajouter', SubmitType::class, ['attr' => ['class'=> 'btn bg-success text-white m-4' ],'row_attr' => ['class' => 'text-center'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Photo::class,
        ]);
    }
}
