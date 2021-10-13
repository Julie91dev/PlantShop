<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'label_attr'=> ['class'=> 'adresse-label']
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'label_attr'=> ['class'=> 'adresse-label']
            ])
            ->add('telephone', IntegerType::class, [
                'label' => 'Téléphone',
                'label_attr'=> ['class'=> 'adresse-label']
            ])
            ->add('numero', IntegerType::class, [
                'label' => 'Numero de rue',
                'required' => false,
                'label_attr'=> ['class'=> 'adresse-label']
            ])
            ->add('rue', TextType::class, [
                'label' => 'Rue',
                'label_attr'=> ['class'=> 'adresse-label']
            ])
            ->add('cp', IntegerType::class, [
                'label' => 'Code Postal',
                'label_attr'=> ['class'=> 'adresse-label']
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'label_attr'=> ['class'=> 'adresse-label']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
