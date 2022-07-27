<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PayementFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nbcarte', TextType::class, ['label' => 'Carte Bancaire :'])
            ->add('Date_year', NumberType::class, ['label' => 'Date Year :'])
            ->add('Date_month', NumberType::class, ['label' => 'Date Month :'])
            ->add('CVC', TextType::class, ['label' => 'CVC :']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Payementdto::class,
        ]);
    }
}