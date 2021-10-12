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
            ->add('telephone', IntegerType::class, [
                'label' => 'Téléphone'
            ])
            ->add('numero', IntegerType::class, [
                'label' => 'Numero de rue',
                'required' => false
            ])
            ->add('rue', TextType::class, [
                'label' => 'Rue'
            ])
            ->add('cp', IntegerType::class, [
                'label' => 'Code Postal'
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville'
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
